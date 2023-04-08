<?php

namespace App\Http\Controllers\Api;

use App\Models\News;
use App\Models\Movie;
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
            'release_time' => 'required|date_format:Y-m-d H:i:s',
            'introduction' => 'required|string',
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

        // dd($validatedData);
        $validatedData = $validator->validated();

        $validatedData['actor_image'] = json_encode($validatedData['actor_image']);
        $movie = Movie::create($validatedData);

        if(!$movie){
            return response()->json([
                'code' => 500,
                'message' => 'Movie could not be added.',
            ]);
        }
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
        return response()->json($news, 201);
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
        return response()->json(['message' => 'News deleted successfully'], 204);
    }




}
