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
            <h6 class="m-0 font-weight-bold text-primary">List budget</h6>
            <a class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#budgetModal" data-title="add">Add Budget</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    @if (Auth::guard('user')->user()->role != ROLE_ADMIN)
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 5% !important;">#</th>
                                <th style="width: 10%;">Category</th>
                                <th style="width: 15%;">Amount</th>
                                <th style="width: 10%;">Period</th>
                                <th style="width: 50%;">Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($budgets as $budget)
                                <tr>
                                    <td class="text-center">{{ $budget->id }}</td>
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
                                <th class="text-center" style="width: 5% !important;">#</th>
                                <th style="width: 10%;">Category</th>
                                <th style="width: 15%;">User</th>
                                <th style="width: 15%;">Amount</th>
                                <th style="width: 10%;">Period</th>
                                <th>Note</th>
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
        </div>
    </div>

    @include('components.modals.delete')
    @include('components.modals.budget')
</div>