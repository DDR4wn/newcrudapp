<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket Show</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#DEF2C8]">
<header class="text-gray-800 font-bold p-4">Ticket system</header>

<main class="flex flex-col items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/2">
        <h2 class="text-xl opacity-80 font-bold mb-4">Ticket Details</h2>
        <div class="text-gray-700">
            <p><span class="font-bold">Ticket ID:</span> {{ $ticket->id }}</p>
            <p><span class="font-bold">Titel:</span> {{ $ticket->titel }}</p>
            <p><span class="font-bold">Omschrijving:</span> {{ $ticket->omschrijving }}</p>
            <p><span class="font-bold">Aangemaakt Op:</span> {{ $ticket->aangemaakt_op }}</p>
            <p><span class="font-bold">Uitgevoerd Op:</span> {{ $ticket->uitgevoerd_op ? $ticket->uitgevoerd_op : '-' }}</p>
        </div>
        <br>
        <a href="{{ route('tickets.edit', $ticket->id) }}" class="mt-4 bg-blue-600 text-white py-2 px-4 rounded">Edit Ticket</a>
        <a href="{{ route('tickets.index') }}" class="mt-4 bg-gray-600 text-white py-2 px-4 rounded">Back to index</a>
    </div>
</main>

<footer class="text-center text-gray-600 py-4 mt-6">
    &copy; Ticketing System, Darren Bleeker
</footer>
</body>
</html>
