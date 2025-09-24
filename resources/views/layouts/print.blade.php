<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - {{ $title }}</title>

    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <style>
        .pdf-container {
            margin: 20px;
            font-family: Arial, sans-serif;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-surat {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .alamat {
            font-size: 12px;
            font-style: italic;
            margin-bottom: 15px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .table th {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
            text-align: center;
        }

        .table td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        .text-nowrap {
            white-space: nowrap;
        }

        .text-center {
            text-align: center;
        }

        .content {
            max-width: 900px;
            margin: 0 auto;
        }
    </style>
</head>

<body onload="window.print()">

    <section class="content">
        <h1>@yield('title')</h1>
        @yield('content')
    </section>

</body>

</html>