<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <div class="mb-6">
            <a href="{{ route('products.index') }}" class="bg-blue-500 text-white py-2 px-4 rounded-md">Back to
                Products</a>
        </div>

        @yield('content')
    </div>
</body>

</html>
