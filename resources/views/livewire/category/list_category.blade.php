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
            <h6 class="m-0 font-weight-bold text-primary">List category</h6>
            <a href="{{ route('category.add') }}" class="btn btn-primary btn-sm float-right">Add Category</a>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <div class="d-flex mb-3 align-items-center">
                        <label class="mb-0 mr-1">Show</label>
                        <select wire:model="pagination" id="pagination" class="custom-select custom-select-sm form-control form-control-sm select-pagination">
                            @foreach (PAGINATION as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                        <label class="mb-0 ml-1">entries</label>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-center gap-1 sorting" style="width: 5% !important;" wire:click="sortBy('id')">
                                <div class="sortable gap-1"><span>#</span>
                            </th>
                            <th style="width: 15%;">Name</th>
                            <th style="width: 10%;">Type</th>
                            <th style="width: 60%;">Description</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="text-center">{{ $category->id }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ getCategoryType($category->type) }}</td>
                                <td>{{ $category->description }}</td>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success btn-sm px-3">Edit</a> 
                                    <a class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#deleteModal" data-idDelete="{{ $category->id }}" data-title="{{ $category->name }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <p>Showing {{ $categories->firstItem() }} to {{ $categories->lastItem() }} of {{ $categories->total() }} entries</p>
                </div>
                <div class="col-sm-12 col-md-7">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('components.modals.delete')
</div>

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('#pagination').on('change', function (e) {
                @this.set('pagination', e.target.value);
            });
        });
    </script>
@endsection