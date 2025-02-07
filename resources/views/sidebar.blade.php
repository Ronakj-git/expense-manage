

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/css/sidebar.css') }}">


</head>
<body>

    @auth
    <div class="sidebar" id="sidebar">
        <button class="toggle-btn" id="toggle-btn">&#9776;</button>
        <div id="sidebarhide">
        <a href="{{route('Dashboard')}}"><h4 class="p-2 py-3">Dashboard</h4></a>
        <a href="{{route('expense')}}" class="nav-link">Add Expense</a>
        <a href="{{route('report')}}" class="nav-link">Reports</a>
        <a href="{{route ('setting')}}" class="nav-link">Settings</a>
    </div>
</div>
    @endauth



    @yield('content');


    <script>
        // Sidebar Toggle Functionality
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const sidebarhide = document.getElementById('sidebarhide');
        const toggleBtn = document.getElementById('toggle-btn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('shifted');
            sidebarhide.classList.toggle('hide');
        });

        // Modal Toggle

    </script>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
        
    {{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}


</body>
</html>
