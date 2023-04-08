<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function showByCatalogue($catalogue)
    {
        $movies = Movie::where('catalogue', $catalogue)->get();

        return response()->json(['data' => $movies]);
    }

    public function indexNews()
    {
        $news = News::all();
        return response()->json($news);
    }

}
