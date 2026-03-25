<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Default School System')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-800">

<div class="min-h-screen grid grid-cols-4 grid-rows-[auto_1fr_auto]">

    <header class="col-span-4 bg-blue-600 text-white p-4">
        <h1 class="text-2xl font-bold">School Management System</h1>
    </header>

    <aside class="col-span-1 bg-gray-200 p-4 border-r">
        <nav>
            <h3 class="font-bold mb-2">Navigation</h3>
            @yield('left-sidebar')
        </nav>
    </aside>

    <main class="col-span-2 p-6 bg-white shadow-md m-4 rounded">
        @yield('content')
    </main>

    <aside class="col-span-1 bg-gray-200 p-4 border-l">
        <h3 class="font-bold mb-2">Quick Actions</h3>
        @yield('right-sidebar')
    </aside>

    <footer class="col-span-4 bg-gray-800 text-white text-center p-4">
        <p>&copy; 2026 Database Administration</p>
    </footer>

</div>

</body>
</html>
