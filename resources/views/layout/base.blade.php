<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
    <link rel="shortcut icon" href="{{ asset('MentoraClean.png') }}" type="image/x-icon">
    {{-- tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    {{-- datatable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <title>Order</title>
    {{-- sweetalert cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- fontawesome cdn --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- flowbite --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    @yield('styles')
    <style>
        :root{
            --primary: #DA9318;
            --secondary: #76460B;
            --tertiary: #FFD43B;
            --dark: #1A202C;
            --light: #F7FAFC;
        }

        html, body{
            scroll-behavior: smooth;
            padding: 0;
            margin: 0;
        }
    </style>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors:{
                        'primary': '#DA9318',
                        'secondary': '#EEBB62',
                        'baseGray': '#f7f6f5',
                    },
                    screens:{
                    }
                },
            },
            corePlugins: {
                preflight: false,
            },
        };
    </script>
</head>

<body>

    {{-- @include('partials.navbar') --}}
    @yield('content')
    {{-- @include('partials.footer') --}}

    @yield('scripts')
</body>

</html>
