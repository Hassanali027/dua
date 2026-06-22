<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dua Mehrama - Admin Dashboard</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/dua-mehrama-favicon.png') }}">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f6f3eb; /* Theme matching background */
            color: #333;
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Sidebar Styles */
        .admin-sidebar {
            width: 260px;
            background-color: #1a1a1a;
            color: #fff;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 100;
            transition: all 0.3s;
            overflow-y: auto;
            overflow-x: hidden;
        }

        /* Custom Scrollbar for Sidebar */
        .admin-sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .admin-sidebar::-webkit-scrollbar-track {
            background: #1a1a1a;
        }
        .admin-sidebar::-webkit-scrollbar-thumb {
            background: #444;
            border-radius: 4px;
        }
        .admin-sidebar::-webkit-scrollbar-thumb:hover {
            background: #666;
        }

        .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            font-size: 20px;
            font-weight: 800;
            color: #fff;
            letter-spacing: 1px;
            text-decoration: none;
            background-color: #000;
        }

        /* Main Content */
        .admin-main {
            flex: 1;
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            transition: all 0.3s;
        }

        /* Header Styles */
        .admin-header {
            height: 70px;
            background-color: #fff;
            border-bottom: 1px solid #eaeaea;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 90;
        }

        .header-title {
            font-size: 18px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .admin-content {
            padding: 30px;
            flex: 1;
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    @include('admin.includes.sidebar')

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Header -->
        @include('admin.includes.header')

        <!-- Page Content -->
        <div class="admin-content">
            @yield('content')
        </div>
    </div>

    @yield('scripts')
</body>
</html>
