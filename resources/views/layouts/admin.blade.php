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
    
    @include('partials.admin.sidebar')

    <div style="flex: 1; display: flex; flex-direction: column;">
        @include('partials.admin.header')

        <main style="flex: 1;">

            <!-- Flash Message Area -->
            @if (session('success'))
                <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px 20px; border-radius: 5px; margin: 20px auto; width: 90%; max-width: 1000px;" id="flash-message">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 12px 20px; border-radius: 5px; margin: 20px auto; width: 90%; max-width: 1000px;" id="flash-message">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<!-- Auto-hide Flash Script -->
<script>
    setTimeout(() => {
        const msg = document.getElementById('flash-message');
        if (msg) {
            msg.style.transition = 'opacity 0.5s ease';
            msg.style.opacity = '0';
            setTimeout(() => msg.style.display = 'none', 500);
        }
    }, 2000);
</script>

@stack('scripts')
</body>
</html>
