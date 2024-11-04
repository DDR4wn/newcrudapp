<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Ticket</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#DEF2C8]">
<header class="text-gray-800 font-bold p-4">Ticket System</header>

<main class="flex flex-col items-center justify-center min-h-screen">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/2">
        <h2 class="text-xl font-bold mb-4">Create New Ticket</h2>
        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf
{{--            @csrf generates token to protect against unwanted attacker requests--}}
            <div class="mb-4">
                <label for="titel" class="block font-bold mb-1">Titel:</label>
                <input type="text" id="titel" name="titel" class="border rounded w-full p-2" required>
            </div>
            <div class="mb-4">
                <label for="omschrijving" class="block font-bold mb-1">Omschrijving:</label>
                <textarea id="omschrijving" name="omschrijving" class="border rounded w-full p-2" required></textarea>
            </div>
            <button type="submit" class="mt-4 bg-blue-600 text-white py-2 px-4 rounded">Create Ticket</button>
            <a href="{{ route('tickets.index') }}" class="mt-4 bg-gray-600 text-white py-2 px-4 rounded">Back to List</a>
        </form>
    </div>
</main>

<footer class="text-center text-gray-600 py-4 mt-6">
    &copy; Ticketing System, Darren Bleeker
</footer>
</body>
</html>
