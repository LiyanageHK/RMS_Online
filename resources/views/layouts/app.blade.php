<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flame & Crust Pizzeria</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body style="margin: 0; font-family: Arial, sans-serif; background-color: #f0f2f5;">

<div style="display: flex; min-height: 100vh;">

    @include('partials.sidebar')

    <div style="flex: 1; display: flex; flex-direction: column;">
        @include('partials.header')

        <main style="flex: 1;">
            @yield('content')
        </main>
    </div>
</div>

</body>
</html>
