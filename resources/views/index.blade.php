<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#DEF2C8]">
<header class="text-gray-800 font-bold p-4">Ticket system</header>

<main class="flex flex-col items-center justify-center min-h-screen">
{{-- table which shows all entries from tickets table in db. --}}
    <table class="text-gray-800 font-semibold border-collapse border rounded-lg shadow-lg overflow-hidden">
        <thead>
        <tr>
            <th class="border-gray-300 bg-[#A9B2AC] text-white p-4">Ticket ID</th>
            <th class="border-gray-300 bg-[#A9B2AC] text-white p-4">Titel</th>
            <th class="border-gray-300 bg-[#A9B2AC] text-white p-4">Aangemaakt Op</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ticketsFound as $ticket)
            @if(is_null($ticket->uitgevoerd_op))
            <tr class="bg-[#C5DAC1] even:bg-[#BCD0C7] cursor-pointer hover:opacity-75"
                onclick="window.location='{{ route('tickets.show', $ticket->id) }}'">
                <td class="border border-gray-300 p-4">{{ $ticket->id }}</td>
                <td class="border border-gray-300 p-4">{{ $ticket->titel }}</td>
                <td class="border border-gray-300 p-4">{{ $ticket->aangemaakt_op }}</td>
            </tr>
            @endif
        @endforeach
        </tbody>
    </table>

{{--   Button redirects to create ticket form page. --}}
    <a href="{{ route('tickets.create') }}" class="mt-6 bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">Create New Ticket</a>
</main>

<footer class="text-center text-gray-600 py-4 mt-6">
    &copy; Ticketing System, Darren Bleeker
</footer>
</body>
</html>
