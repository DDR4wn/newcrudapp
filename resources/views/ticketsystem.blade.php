<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket List</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background-color: #DEF2C8;">
<header class="text-gray-800 font-bold p-4">Ticket system</header>
<main class="flex items-center justify-center min-h-screen">
    <table class="text-gray-800 font-semibold border-collapse border rounded-lg shadow-lg overflow-hidden">
        <thead>
        <tr>
            <th class="border border-gray-300 bg-[#A9B2AC] text-white p-4">Ticket ID</th>
            <th class="border border-gray-300 bg-[#A9B2AC] text-white p-4">Titel</th>
{{--            <th class="border border-gray-300 bg-[#A9B2AC] text-white p-4">Omschrijving</th>--}}
            <th class="border border-gray-300 bg-[#A9B2AC] text-white p-4">Aangemaakt Op</th>
{{--            <th class="border border-gray-300 bg-[#A9B2AC] text-white p-4">Uitgevoerd Op</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($ticketsFound as $ticket)
            <tr class="bg-[#C5DAC1] even:bg-[#BCD0C7]">
                <td class="border border-gray-300 p-4">{{ $ticket->id }}</td>
                <td class="border border-gray-300 p-4">{{ $ticket->titel }}</td>
                <!-- <td class="border border-gray-300 p-4">{{ $ticket->omschrijving }}</td> -->
                <td class="border border-gray-300 p-4">{{ $ticket->aangemaakt_op }}</td>
{{--                <td class="border border-gray-300 p-4">{{ $ticket->uitgevoerd_op }}</td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
</main>

<footer class="text-center text-gray-600 py-4 mt-6">
    &copy; Ticketing System, Darren Bleeker
</footer>
</body>
</html>
