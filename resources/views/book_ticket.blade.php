@extends('master')

<div class="container">
    <h1>Book Movie Tickets</h1>

    <form action="{{ route('ticket.save') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="theaterSelect" class="form-label">Select a Theater:</label>
            <select class="form-select" id="theaterSelect" name="theaterSelect" required>
                <option value="" disabled selected>Select a theater</option>
                @foreach ($theaters as $theater)
                    <option value="{{ $theater->id }}">
                        {{ $theater->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="movieName" class="form-label">Select a Movie:</label>
            <select class="form-select" id="movieName" name="movieName" required>
                <option value="" disabled selected>Select a movie</option>
                @foreach ($shows as $show)
                    <option value="{{ $show->movie_name }}">
                        {{ $show->movie_name }}
                    </option>
                @endforeach
            </select>
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
            <input type="number" class="form-control" id="numSeats" name="numSeats" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary">Book Tickets</button>
    </form>
</div>
