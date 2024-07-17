<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        .content-wrapper {
            display: flex;
            height: 100vh; /* Viewportの高さを設定 */
        }
        .sidebar {
            width: 300px;
            padding: 1.5rem;
            background: linear-gradient(to top, #f3c6d2, #f2e0ea);
            color: white;
            border-radius: 0.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }
        .sidebar .logo {
            text-align: center;
            color: black;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .sidebar .logo img {
            max-width: 150px;
            margin: 0 auto 1rem;
        }
        .sidebar ul {
            flex: 1;
            padding: 0;
            list-style: none;
        }
        .main-content {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem; /* 任意で調整 */
        }
        .footer {
            text-align: center;
            padding: 1rem;
            background-color: #f8f8f8;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900 content-wrapper">
        @include('layouts.sidebar')

        <div class="main-content">
          @include('layouts.navigation') <!-- ナビゲーションを含める -->
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                @yield('content')
            </main>

            <!-- Footer (戻るボタン) -->
            @hasSection('back-link')
                <div class="footer">
                    <a href="@yield('back-link')" class="btn btn-custom-blue">
                        戻る
                    </a>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
