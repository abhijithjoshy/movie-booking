<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <h1>Ticket</h1>
    <p>Theater Name: {{ $theater_name }}</p>
    <p>Movie Name: {{ $ticket->movie_name }}</p>
    <p>Show Date: {{ $ticket->show_date }}</p>
    <p>Show Time: {{ $ticket->show_time }}</p>
    <p>Number of Seats: {{ $ticket->num_seats }}</p>
    <p>Booking ID: {{ $ticket->booking_id }}</p>

    <p>Thank you for booking with us!</p>
</body>

</html>
