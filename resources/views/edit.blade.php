<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Ticket</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#DEF2C8]">
<header class="text-gray-800 font-bold p-4">Ticket system</header>

<main class="flex flex-col items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/2">
        <h2 class="text-xl font-bold mb-4">Edit Ticket</h2>

{{--        on submit sends editable form fields' info to update endpoint.--}}
        <form action="{{ route('tickets.update', $ticket->id) }}" method="POST">

            {{--            @csrf generates token to protect against unwanted attacker requests--}}
            @csrf
{{--            browser sends it as post request because html doesn't support put, but laravel can understand its actually a put--}}
            @method('PUT')
            <div class="mb-4">
                <p><span class="text-gray-700 block font-bold mb-1">ID: </span>{{ $ticket->id }}</p>
            </div>
            <div class="mb-4">
                <label for="titel" class="block font-bold mb-1">Titel:</label>
                <input type="text" id="titel" name="titel" value="{{ $ticket->titel }}" class="border rounded w-full p-2" required>
            </div>
            <div class="mb-4">
                <label for="omschrijving" class="block font-bold mb-1">Omschrijving:</label>
                <textarea id="omschrijving" name="omschrijving" class="border rounded w-full p-2" required>{{ $ticket->omschrijving }}</textarea>
            </div>
            <div class="mb-4">
                <p><span class="text-gray-700 block font-bold mb-1">Aangemaakt op: </span>{{ $ticket->aangemaakt_op }}</p>
            </div>
            <div class="mb-4">
                <label for="uitgevoerd_op" class="block font-bold mb-1">Uitgevoerd Op:</label>
                <input type="date" id="uitgevoerd_op" name="uitgevoerd_op" value="{{ $ticket->uitgevoerd_op }}" class="border rounded w-full p-2">
            </div>

            <button type="submit" class="mt-4 bg-blue-600 text-white py-2 px-4 rounded">Update Ticket</button>

{{--            takes user back to table of all ticket db entries.--}}
            <a href="{{ route('tickets.index') }}" class="mt-4 bg-gray-600 text-white py-2 px-4 rounded">Back to List</a>
        </form>
    </div>
</main>

<footer class="text-center text-gray-600 py-4 mt-6">
    &copy; Ticketing System, Darren Bleeker
</footer>
</body>
</html>


