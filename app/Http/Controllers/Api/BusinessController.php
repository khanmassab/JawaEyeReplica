<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recharge;
use App\Models\Withdrawal;
use App\Models\Balance;
use App\Models\User;
use App\Models\Movie;
use App\Models\Ticket;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\DB;
use App\Jobs\ReturnProfit;

class BusinessController extends Controller
{

    public function addWallet(Request $request){
        $user = auth()->user();

        if($user->walled_address){
            return response()->json(['code' => 403, 'message' => 'You are not allowed to change the walled address']);
        }
        
        if($user){
            $user->wallet_address = $request->input('wallet_address');
            $user->wallet_type = $request->input('wallet_type');
            $user->funding_password = $request->input('funding_password');
            $user->save();

            return response()->json(['code' => 200, 'message' => 'Walled added to your account', $user->wallet_address, $user->wallet_type]);
        }
    }

    public function recharge(Request $request)
    {
        try {
        //     $validator = Validator::make($request->all(), [
        //     'amount' => 'required|numeric|min:0',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json(['error' => $validator->errors()], 422);
        // }

        if($request->amount < 50){
            return response()->json(['code' => 403, 'message' => 'You cannot make rechage less than 50']);
        }
        $user = auth()->user();


        if ($request->hasFile('proof_screenshot')) {
            $file = $request->file('proof_screenshot');
            $screenshotPath = $file->hashName('public');
            $screenshotPath = $file->storePubliclyAs('public', $screenshotPath);
        }
        // if ($request->hasFile('proof_screenshot')) {
        //     \Log::info('Accepted');
        // } else {
        //     \Log::info('Failed');
        // }




        $recharge = new Recharge();
        $recharge->user_id = $user->id;
        $recharge->amount = $request->input('amount');
        $recharge->sender_binance = $request->input('sender_binance');
        $recharge->binance_link = $request->input('binance_link');
        $recharge->proof_screenshot = $screenshotPath;
        $recharge->save();


        \Log::info($request);
        \Log::info($screenshotPath);

        \Log::info($recharge);

        // var_dump($recharge);

        if($recharge){
            return response()->json(['code' => 200, 'message' => 'Recharge request submitted. Your recharge amount will be added to your balance in 24 hours.', 'data' => $recharge]);
        }

        } catch (\Throwable $th) {
        \Log::info($th->getMessage());

            throw $th;
            // return response()->json(['code' => 500, 'message' => 'Something went wrong']);
        }
    }

    public function withdrawal(Request $request)
    {
        $user = auth()->user();

        $withdrawal_amount = $request->input('withdrawal_amount');
        $balance = Balance::where('user_id', $user->id)->value('balance');

        if ($balance < $withdrawal_amount) {
            return response()->json(['code' => 400, 'message' => 'Insufficient balance'], 400);
        }

        if( $request->funding_password != $user->funding_password){
            return response()->json(['code' => 401, 'message' => 'Invalid Password'], 401);
        }


        // dd($user);
        $withdrawal = new Withdrawal();
        $withdrawal->user_id = $user->id;
        // $withdrawal->wallet_address = $user->wallet_address;
        // $withdrawal->wallet_type = $request->wallet_type;
        $withdrawal->withdrawal_amout = $request->input('withdrawal_amount');
        $withdrawal->save();

        if($withdrawal){
            return response()->json(['code' => 200, 'message' => 'Withdrawal request submitted. Your amount will be transferred to your wallet in 24 hours.', $withdrawal]);
        }

        return response()->json(['code' => 500, 'message' => 'Something went wrong']);
    }

    public function buyTicket(Request $request, $movieId)
    {
        $user = auth()->user();
        $movie = Movie::find($movieId);
        $price = $movie->price;
        $quantity = $request->input('quantity', 1); // Default to 1 if quantity is not provided

        // Check if user has sufficient balance
        if ($user->balance->balance >= $price * $quantity) {
            
            $lastPurchase = Ticket::where('user_id', $user->id)
            ->where('movie_id', $movieId)
            ->where('booked_at', '>=', now()->subHours(24))
            ->first();

            if ($lastPurchase) {
                // User has already purchased a ticket for this movie in the last 24 hours
                return response()->json(['code' => 400, 'message' => 'You have already purchased a ticket for a movie in the last 24 hours']);
            }
            // return $user->balance->balance;
            $user->balance->balance -= $price * $quantity;
            $user->balance->save();

            // Add 2% of ticket price to ticket quota
            $gains = $user->gain()->firstOrNew([]);

            
            $gains->personal_gains += $price * $quantity * 0.02;
            $gains->ticket_quota += $price * $quantity;
            
            // Save changes to user and gains
            $user->save();
            $gains->save();
            
            // return $gains;


            $ticket = new Ticket();
            $ticket->user_id = $user->id;
            $ticket->movie_id = $movie->id;
            $ticket->quantity = $quantity;
            $ticket->price = $price;
            $ticket->status = 0;
            $ticket->booked_at = now();
            $ticket->expiry_at = now()->addHours(24);
            $ticket->save();

            return response()->json(['code' => 202, 'message' => 'Ticket booking in progress']);
        }

        return response()->json(['code' => 400, 'message' => 'Insufficient balance']);
    }


    public function checkBalance(Request $request)
{
    $user = auth()->user();

    // Get all non-completed tickets for the user
    $tickets = Ticket::where('user_id', $user->id)
                     ->where('status', '!=', 1)
                     ->get();


    // Loop through all the tickets
    foreach ($tickets as $ticket) {
        // Check if the ticket has expired
        if ($ticket->expiry_at <= now()) {
            
            $quantity = $ticket->quantity;
            $price = $ticket->price;

            
            // Calculate profit from expired ticket and update user balance
            $profit = $price + ($price * 0.02);
            $user->balance->balance += $profit * $quantity;
            $user->balance->save();


            // Update user gains
            $gains = $user->gain()->firstOrNew([]);
            
            // $gains->ticket_quota = 100;
            $gains->ticket_quota -= $price * $quantity;
            $gains->personal_gains += $price * $quantity * 0.02;
            $gains->save();
                        

            // Mark the ticket as completed
            $ticket->status = 1;
            $ticket->save();

            // Update the referer's gains if there is one
            $code = auth()->user()->invitation_code;
            $userReferer = DB::table('invitation_codes')->where('invitation_code', $code)->latest()->first();
            $userReferer = User::find($userReferer->user_id);
            
            // return $userReferer;

            if ($userReferer) {
                $refererGain = $userReferer->gain()->firstOrNew([]);
                $refererGain->team_earning += $price * $quantity * 0.0004;
                $refererGain->save();
            }
        }
    }


    $balance = null; 
    if($user->balance){
        $balance = $user->balance->balance;
    }
    
    
    $gain = null; 
    if($user->gain){
        $gain = $user->gain;
    }


    // 225|aaihAdzHSGAoFVRsMtftNT7VFZ8hkHM5sx2Wdm3d

    $code = DB::table('invitation_codes')->where('user_id', auth()->id())->latest()->first()->invitation_code;
    $total_added_people = DB::table('users')->where('invitation_code', $code)->get()->count();
    return response()->json(['code' => 200, 'balance' => $balance, 'personal_gain' => $gain, 'total_added_people' => $total_added_people]);
}

    public function accountHistory(){

        $withdrawals = Withdrawal::where('status', 'approved')
        ->where('user_id', auth()->id())
        ->orderByDesc('created_at')
        ->get(['created_at as date_time', 'withdrawal_amout as amount', 'status', 'id', DB::raw("'withdrawal' as transaction_type")]);
    
    $recharges = Recharge::where('status', 'approved')
        ->where('user_id', auth()->id())
        ->orderByDesc('created_at')
        ->get(['created_at as date_time', 'amount as amount', 'status', 'id', DB::raw("'recharge' as transaction_type")]);
    
    $transactions = $withdrawals->merge($recharges)
        ->sortByDesc('date_time')
        ->groupBy('transaction_type')
        ->map(function ($groupedTransactions) {
            return $groupedTransactions->values();
        });
    
    return response()->json($transactions->values()->flatten());
    
    }

    public function getBalance(){
        $user = auth()->user();
        $balance = Balance::where('user_id', $user->id)->first();
        $balanceAmount = $balance ? $balance->balance : 0;
        return response()->json(intval($balanceAmount));
    }

}
