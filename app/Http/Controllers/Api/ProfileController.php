<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use App\Models\Movie;
use App\Models\Advertisement;
use App\Models\User;
use App\Models\Notification;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function showByCatalogue($catalogue)
    {
        $movies = Movie::where('catalogue', $catalogue)->get();

        return response()->json($movies);
    }

    public function indexNews()
    {
        $news = News::all();
        return response()->json($news);
    }

    public function uploadProfilePicture(Request $request)
    {
        $user = auth()->user();
        
        // Validate the uploaded file
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        // Store the uploaded file in the storage/app/public directory
        $profilePicturePath = $request->file('profile_picture')->store('public');
        
        // Save the path to the profile picture in the user's profile_picture column
        $user->profile_picture = $profilePicturePath;
        $user->save();        


        if($user){
            return response()->json(['code' => 200, 'message' => 'Profile picture uploaded successfully', 'profile_picture' => $profilePicturePath]);
        }

        return response()->json(['code' => 500, 'message' => 'Something went wrong']);
    }

    public function deleteProfilePicture(Request $request)
    {
        $user = $request->user();
        
        // Delete the user's profile picture if it exists
        if ($user->profile_picture) {
            Storage::delete($user->profile_picture);
            $user->profile_picture = null;
            $user->save();
        }
        
        return response()->json(['code' => 200, 'message' => 'Profile picture deleted successfully']);
    }

    public function indexAd()
    {
        $advertisements = Advertisement::all();
        
        return response()->json( $advertisements);
    }
    
    public function indexService()
    {
        $service = Service::all();
        
        return response()->json( $service);
    }
    
    public function indexNotification()
    {
        $notifications = Notification::orderBy('created_at', 'desc')->take(10)->get();
        
        return response()->json( $notifications);
    }

}
