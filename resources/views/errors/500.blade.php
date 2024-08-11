<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fc;
        }
        #content {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .error {
            font-size: 7rem;
            font-weight: 700;
            margin: 0 auto;
        }
    </style>
</head>

<body id="page-top">
    <div id="content">
        <div class="container-fluid">
            <div class="text-center">
                <div class="error" data-text="500">500</div>
                <h2 class="text-gray-800 mb-5">Internal Server Error</h2>
                <a href="{{ route('dashboard') }}">BACK TO DASHBOARD</a>
            </div>
        </div>
    </div>
</body>
</html>
