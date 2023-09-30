<?php

namespace App\Http\Controllers;

use App\Models\TheaterDetails;
use App\Models\TheaterList;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TheaterController extends Controller
{

    public function index(Request $request)
    {

        $theater_list = TheaterList::select('name', 'id')->get();

        $shows = TheaterDetails::get();
        // dd($shows);

        return view('dashboard', ['theater_list' => $theater_list, 'shows' => $shows]);
    }

    public function create_theater(Request $request)
    {

        try {

            $theater_list = new TheaterList;
            $theater_list->name = $request->theaterName;
            $theater_list->email = $request->theaterEmail;
            $theater_list->save();
        } catch (Exception $e) {
        }
    }

    public function create_show(Request $request)
    {
        // dd($request->all());
        // Validate the request data
        $request->validate([
            'theaterSelect' => 'required',
            'movieName' => 'required',
            'showDate' => 'required|date',
            'showTime' => 'required',
            'numSeats' => 'required|integer',
            'movieThumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust allowed image formats and size as needed.
        ]);

        // Handle the image upload
        $imagePath = $request->file('movieThumbnail')->store('images'); // You can adjust the storage path as needed.

        // Create a new TheaterDetails model and populate it with the request data
        $theaterDetail = new TheaterDetails();
        $theaterDetail->theater_name = $request->input('theaterSelect');
        $theaterDetail->movie_name = $request->input('movieName');
        $theaterDetail->show_date = $request->input('showDate');
        $theaterDetail->show_time = $request->input('showTime');
        $theaterDetail->num_seats = $request->input('numSeats');
        $theaterDetail->movie_thumbnail_path = $imagePath;
        $theaterDetail->save();

        return response()->json(['message' => 'Data saved successfully']);
    }


    public function show($filename)
    {
        $path = 'thumbnails/' . $filename;

        // Check if the file exists in storage
        if (Storage::exists($path)) {
            $file = Storage::get($path);
            $mimeType = Storage::mimeType($path);

            return response($file, 200)->header('Content-Type', $mimeType);
        }

        // Handle the case when the file doesn't exist
        abort(404);
    }
}
