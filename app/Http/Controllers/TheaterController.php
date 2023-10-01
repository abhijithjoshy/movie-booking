<?php

namespace App\Http\Controllers;

use App\Mail\InformUser;
use App\Models\TheaterDetails;
use App\Models\TheaterList;
use App\Models\Tickets;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TheaterController extends Controller
{

    public function index(Request $request)
    {

        $theater_list = TheaterList::select('name', 'id')->get();

        $shows = TheaterDetails::get();

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
        $request->validate([
            'theaterSelect' => 'required',
            'movieName' => 'required',
            'showDate' => 'required|date',
            'showTime' => 'required',
            'numSeats' => 'required|integer',
            'movieThumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust allowed image formats and size as needed.
        ]);


        // upload the file
        $imagePath = $request->file('movieThumbnail')->store('images'); // You can adjust the storage path as needed.

        $theaterDetail = new TheaterDetails();
        $theaterDetail->theater_id = $request->input('theaterSelect');
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

        if (Storage::exists($path)) {
            $file = Storage::get($path);
            $mimeType = Storage::mimeType($path);

            return response($file, 200)->header('Content-Type', $mimeType);
        }

        abort(404);
    }

    public function book()
    {

        $theater_list = TheaterList::select('name', 'id')->get();

        $shows = TheaterDetails::get();



        return view('book_ticket', ['theaters' => $theater_list, 'shows' => $shows]);
    }



    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'theaterSelect' => 'required|exists:theater_lists,id',
            'movieName' => 'required|string|max:255',
            'showDate' => 'required|date',
            'showTime' => 'required|date_format:H:i',
            'numSeats' => 'required|integer|min:1',
            'email' => 'required|email',
        ]);

        $ticket = new Tickets();
        $ticket->theater_id = $validatedData['theaterSelect'];
        $ticket->movie_name = $validatedData['movieName'];
        $ticket->show_date = $validatedData['showDate'];
        $ticket->show_time = $validatedData['showTime'];
        $ticket->num_seats = $validatedData['numSeats'];
        $ticket->booking_id = Str::random(10);

        $ticket->email = $validatedData['email'];

        $ticket->save();

        Mail::to($validatedData['email'])->send(new InformUser($ticket));

        return redirect()->route('booking_completed')->with('success', 'Ticket booked successfully!');
    }
}
