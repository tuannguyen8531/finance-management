<div>
    <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

    @if (Session::has('message'))
        <div id="alert-message" class="alert alert-{{ Session::get('status') }}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List user</h6>
            <a href="{{ route('user.add') }}" class="btn btn-primary btn-sm float-right">Add User</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 5% !important;">#</th>
                            <th style="width: 20%;">Name</th>
                            <th style="width: 20%;">Username</th>
                            <th style="width: 30%;">Email</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role == ROLE_ADMIN)
                                        Admin
                                    @else
                                        User
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('user.detail', $user->id) }}" class="btn btn-success btn-sm px-3">Edit</a>
                                    <a class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#deleteModal" data-idDelete="{{ $user->id }}" data-title="{{ $user->name }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('components.modals.delete')
</div>

@section('javascript')
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
        });
    </script>
@endsection