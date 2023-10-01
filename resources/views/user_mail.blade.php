<!DOCTYPE html>
<html>
<head>
    <title>Ticket Successfully Created</title>
</head>
<body>
    <h1>Ticket Successfully Created</h1>
    <p>Your ticket has been successfully created. Here are the details:</p>
    <ul>
        <li>Theater Name: {{ $theater_name}}</li>
        <li>Movie Name: {{ $ticket->movie_name }}</li>
        <li>Show Date: {{ $ticket->show_date }}</li>
        <li>Show Time: {{ $ticket->show_time }}</li>
        <li>Number of Seats: {{ $ticket->num_seats }}</li>
        <li>Booking ID: {{ $ticket->booking_id }}</li>
    </ul>

    <p>Thank you for booking with us!</p>
</body>
</html>
