<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Management</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
</head>

<body>
    {{ $slot }}

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <!-- <script src="{{ asset('js/demo/datatables-demo.js') }}"></script> -->
    {{-- <script src="{{ asset('js/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-bar-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('iddelete');
                var title = button.data('title');
                var modal = $(this);
                modal.find('.modal-body #nameDelete').text(title);
                modal.find('.modal-footer #confirmDelete').attr('wire:click', 'delete(' + id + ')');
            });

            if ($('#alert-message').length) {
                setTimeout(function () {
                    $('#alert-message').fadeOut();
                }, 3000);
            };

            $('.id-sort').on('click', function () {
                if ($(this).hasClass('sort-asc')) {
                    console.log('Changing from sort-asc to sort-desc');
                    $(this).removeClass('sort-asc').addClass('sort-desc');
                } else {
                    console.log('Changing from sort-desc to sort-asc');
                    $(this).removeClass('sort-desc').addClass('sort-asc');
                }
            });
        });
    </script>

    @yield('script')
</body>
</html>