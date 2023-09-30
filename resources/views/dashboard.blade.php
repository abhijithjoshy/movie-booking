@extends('master')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Addnewtheater">
                        Add new theater
                    </button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Addshows">
                        Add shows
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-4">
        <h3>Show Details</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Theater Name</th>
                    <th>Movie Name</th>
                    <th>Show Date</th>
                    <th>Show Time</th>
                    <th>Number of Seats</th>
                    <th>Movie Thumbnail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($shows as $show)
                    <tr>
                        <td>{{ $show->movie_name }}</td>
                        <td>{{ $show->movie_name }}</td>
                        <td>{{ $show->show_date }}</td>
                        <td>{{ $show->show_time }}</td>
                        <td>{{ $show->num_seats }}</td>
                        <td>
                            <td>
                                <img src="{{ Storage::url($show->movie_thumbnail_path ) }}" alt="Movie Thumbnail" width="100">
                            </td>
                            
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</x-app-layout>

<div class="modal fade" id="Addnewtheater" tabindex="-1" aria-labelledby="Addnewtheaterlabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="Addnewtheaterlabel">Add</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="theaterForm">
                    @csrf
                    <div class="mb-3">
                        <label for="theaterName" class="form-label">Theater Name:</label>
                        <input type="text" class="form-control" id="theaterName" name="theaterName"
                            placeholder="Enter theater name" required>
                    </div>
                    <div class="mb-3">
                        <label for="theaterEmail" class="form-label">Theater Email:</label>
                        <input type="email" class="form-control" id="theaterEmail" name="theaterEmail"
                            placeholder="Enter theater email" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="submitTheater" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Addshows" tabindex="-1" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="">Add</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addShowsForm" action="{{ route('saveShow') }}" enctype="multipart/form-data"> @csrf
                    <div class="mb-3">
                        <label for="theaterSelect" class="form-label">Theater Name:</label>
                        <select class="form-select" id="theaterSelect" name="theaterSelect" required>
                            <option value="" disabled selected>Select a theater</option>

                            @foreach ($theater_list as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach

                            <!-- Add more theater options as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="movieName" class="form-label">Movie Name:</label>
                        <input type="text" class="form-control" id="movieName" name="movieName"
                            placeholder="Enter movie name" required>
                    </div>
                    <div class="mb-3">
                        <label for="showDate" class="form-label">Show Date:</label>
                        <input type="date" class="form-control" id="showDate" name="showDate" required>
                    </div>
                    <div class="mb-3">
                        <label for="showTime" class="form-label">Show Time:</label>
                        <input type="time" class="form-control" id="showTime" name="showTime" required>
                    </div>
                    <div class="mb-3">
                        <label for="numSeats" class="form-label">Number of Seats:</label>
                        <input type="number" class="form-control" id="numSeats" name="numSeats"
                            placeholder="Enter number of seats" required>
                    </div>
                    <div class="mb-3">
                        <label for="movieThumbnail" class="form-label">Movie Thumbnail Image:</label>
                        <input type="file" class="form-control" id="movieThumbnail" name="movieThumbnail"
                            accept="image/*" required>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" id="submitShows" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
