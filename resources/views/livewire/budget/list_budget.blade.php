<div>
    <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

    @if (Session::has('message'))
        <div id="alert-message" class="alert alert-{{ Session::get('status') }}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <!-- Filter -->
    @if (Auth::guard('user')->user()->role == ROLE_ADMIN)
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Filter</h6>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="filter" wire:reset="clear">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category" id="category" wire:model="search.category">
                                    <option value="">All</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>User</label>
                                <input type="text" class="form-control" name="user" id="user" wire:model="search.user">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Period</label>
                                <select class="form-control" name="period" id="period" wire:model="search.period">
                                    <option value="">All</option>
                                    @foreach (PERIOD as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>From amount (VND)</label>
                                <input type="number" class="form-control" name="amount_from" min="0" wire:model="search.amount_from">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>to (VND)</label>
                                <input type="number" class="form-control" name="amount_to" min="0" wire:model="search.amount_to">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">List budget</h6>
            <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#budgetModal" data-title="add">Add Budget</a>
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
                    @if (Auth::guard('user')->user()->role != ROLE_ADMIN)
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5% !important;">#</th>
                                <th style="width: 10%;">Category</th>
                                <th style="width: 15%;" class="gap-1 sorting" wire:click="sortBy('amount')">Amount</th>
                                <th style="width: 10%;">Period</th>
                                <th style="width: 50%;">Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($budgets as $budget)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $budget->category_name }}</td>
                                    <td>{{ number_format($budget->amount) }} VND</td>
                                    <td>{{ getPeriodType($budget->period) }}</td>
                                    <td>{{ $budget->note }}</td>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-success btn-sm px-3" 
                                            data-toggle="modal" 
                                            data-target="#budgetModal" 
                                            data-title="edit" 
                                            data-id="{{ $budget->id }}"
                                            data-category="{{ $budget->category_id }}"
                                            data-amount="{{ $budget->amount }}"
                                            data-period="{{ $budget->period }}"
                                            data-note="{{ $budget->note }}">Edit
                                        </a> 
                                        <a class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#deleteModal" data-idDelete="{{ $budget->id }}" data-title="{{ $budget->category_name }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @else
                        <thead>
                            <tr>
                                <th class="text-center gap-1 sorting" style="width: 5% !important;" wire:click="sortBy('id')">
                                    <div class="sortable gap-1"><span>#</span>
                                </th>
                                <th style="width: 10%;">Category</th>
                                <th style="width: 15%;">User</th>
                                <th style="width: 15%;" class="gap-1 sorting" wire:click="sortBy('amount')">Amount</th>
                                <th style="width: 10%;">Period</th>
                                <th style="width: 35%;">Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($budgets as $budget)
                                <tr>
                                    <td class="text-center">{{ $budget->id }}</td>
                                    <td>
                                        <a class="chakra-link" href="{{ route('category.edit', $budget->category_id) }}">{{ $budget->category_name }}</a>
                                    </td>
                                    <td>
                                        <a class="chakra-link" href="{{ route('user.edit', $budget->user_id) }}">{{ $budget->user_username }}</a>
                                    </td>
                                    <td>{{ number_format($budget->amount) }} VND</td>
                                    <td>{{ getPeriodType($budget->period) }}</td>
                                    <td>{{ $budget->note }}</td>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-success btn-sm px-3" 
                                            data-toggle="modal" 
                                            data-target="#budgetModal" 
                                            data-title="edit" 
                                            data-id="{{ $budget->id }}"
                                            data-category="{{ $budget->category_id }}"
                                            data-amount="{{ $budget->amount }}"
                                            data-period="{{ $budget->period }}"
                                            data-note="{{ $budget->note }}"
                                            data-user="{{ $budget->user_username }}">Edit
                                        </a> 
                                        <a class="btn btn-danger btn-sm btn-delete" data-toggle="modal" data-target="#deleteModal" data-idDelete="{{ $budget->id }}" data-title="{{ $budget->category_name }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
                </table>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <p>Showing {{ $budgets->firstItem() }} to {{ $budgets->lastItem() }} of {{ $budgets->total() }} entries</p>
                </div>
                <div class="col-sm-12 col-md-7">
                    {{ $budgets->links() }}
                </div>
            </div>
        </div>
    </div>

    @include('components.modals.delete')
    @include('components.modals.budget')
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