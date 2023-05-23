<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use App\Models\Movie;
use App\Models\Service;
use App\Models\Advertisement;
use App\Models\Notification;
use App\Models\Recharge;
use App\Models\Withdrawal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function postMovie(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'poster' => 'required|string',
            'title' => 'required|string',
            'duration' => 'required|integer',
            // 'release_time' => 'required|date_format:Y-m-d H:i:s',
            'introduction' => 'required',
            'actor_image' => 'required|array',
            'actor_image.*' => 'string',
            'description' => 'nullable|string',
            'price' => 'required|integer',
            'sheets_per_ticket' => 'required|integer',
            'instructions' => 'required|string',
            'income' => 'required|string',
            'catalogue' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'error' => $validator->errors()->first(),
            ]);
        }
        $validatedData = $validator->validated();

        $validatedData['actor_image'] = json_encode($validatedData['actor_image']);
        $validatedData['release_time'] = date('Y-m-d H:i:s', strtotime($request->input('release_time')));
        $movie = Movie::create($validatedData);

        if(!$movie){
            return response()->json([
                'code' => 500,
                'message' => 'Movie could not be added.',
            ]);
        }

        return redirect()->back();
        return response()->json([
            'code' => 200,
            'message' => 'Movie created successfully.',
            'movie' => $movie,
        ]);
    }

    public function postNews(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'poster' => 'required|string',
            'release_time' => 'required|date_format:Y-m-d',
            'detail' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 422,
                'error' => $validator->errors()->first(),
            ]);
        }

        // dd($validatedData);
        $validatedData = $validator->validated();
 
        $news = News::create($validatedData);

        return back();
        // return response()->json($news, 201);
    }

    public function updateNews(Request $request, $id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $validatedData = $request->validate([
            'poster' => 'required|string',
            'release_time' => 'required|date_format:Y-m-d H:i:s',
            'detail' => 'required|string',
        ]);

        $news->update($validatedData);
        return response()->json($news, 200);
    }

    public function destroyNews($id)
    {
        $news = News::find($id);

        if (!$news) {
            return response()->json(['message' => 'News not found'], 404);
        }

        $news->delete();

        return back();

        // return response()->json(['message' => 'News deleted successfully'], 204);
    }

    public function destroyMovie($id)
    {
        $movie = Movie::find($id);

        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        $movie->delete();

        return back();

        // return response()->json(['message' => 'News deleted successfully'], 204);
    }

    public function destroyNotification($id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->delete();

        return back();

        // return response()->json(['message' => 'News deleted successfully'], 204);
    }

    public function postAdvertisement(Request $request)
    {
        $validatedData = $request->validate([
            'ad_pic' => 'required',
            'ad_link' => 'required'
        ]);

        $adPic = $request->file('ad_pic')->store('public');

        $advertisement = new Advertisement();
        $advertisement->ad_pic = $adPic;
        $advertisement->ad_link = $validatedData['ad_link'];
        $advertisement->save();

        return back();


        // return response()->json(['code' => 200, 'message' => 'Advertisement created successfully', 'ad' => $advertisement ]);
    }

    public function deleteAd($id)
    {
        $advertisement = Advertisement::find($id);

        if (!$advertisement) {
            return response()->json(['code' => 404, 'message' => 'Advertisement not found']);
        }

        $advertisement->delete();

        return back();

        // return response()->json(['code' => 200, 'message' => 'Advertisement deleted successfully']);
    }

    public function postService(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'contact' => 'required'
        ]);

        $service = new Service();
        $service->title = $validatedData['title'];
        $service->contact = $validatedData['contact'];
        $service->save();

        return back();


        // return response()->json(['code' => 200, 'message' => 'Service created successfully', 'service' => $service ]);
    }

    public function deleteService($id)
    {
        $service = Service::find($id);

        if (!$service) {
            return response()->json(['code' => 404, 'message' => 'service not found']);
        }

        $service->delete();

        return back();
        // return response()->json(['code' => 200, 'message' => 'service deleted successfully']);
    }

    public function postNotification(Request $request)
    {
        $validatedData = $request->validate([
            'notification_text' => 'required',
        ]);

        $notification = new Notification();
        $notification->notification_text = $validatedData['notification_text'];
        $notification->save();

        // dd($notification);

        return back();

        // return response()->json(['code' => 200, 'message' => 'Notification created successfully', 'notification' => $notification ]);
    }

    public function approveRecharge($id)
    {
        $recharge = Recharge::findOrFail($id);
        $recharge->approve();

        return back();
        // return response()->json(['code' => 200, 'message' => 'Recharge request approved. Balance updated.']);
    }

    public function declineRecharge($id)
    {
        $recharge = Recharge::findOrFail($id);
        $recharge->decline();

        return back();
        // return response()->json(['code' => 200, 'message' => 'Recharge request declined.']);
    }

    public function approveWithdrawal($id)
    {

        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->approve();

        return back();


        // return response()->json(['code' => 200, 'message' => 'Withdrawal request approved. Balance updated.']);
    }

    public function declineWithdrawal($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->decline();

        return back();


        // return response()->json(['code' => 200, 'message' => 'Withdrawal request declined.']);
    }
}
