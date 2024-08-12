<!-- Budget modal -->
<div class="modal fade" id="budgetModal" tabindex="-1" role="dialog" aria-labelledby="budgetTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="budgetTitle"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                    <input type="hidden" id="submitId" wire:model.live="budgetId">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" wire:model="categoryId">
                                    <option value="">Select category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('categoryId') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if (Auth::guard('user')->user()->role == ROLE_ADMIN)
                                <div class="form-group">
                                    <label>User</label>
                                    <input type="text" class="form-control" wire:model="userUsername">
                                    @error('userUsername') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" class="form-control" wire:model="amount">
                                @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                                <label>Period</label>
                                <select class="form-control" wire:model="period">
                                    <option value="{{ null }}">Select period</option>
                                    <option value="0">Daily</option>
                                    <option value="1">Weekly</option>
                                    <option value="2">Monthly</option>
                                    <option value="3">Annually</option>
                                    <option value="4">One-time</option>
                                </select>
                                @error('period') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Note</label>
                                <textarea class="form-control" wire:model="note" rows="5"></textarea>
                                @error('note') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="confirmBudgetSave" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
    <script>
        $('#budgetModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var modal = $(this);
            modal.find('.modal-title').text(title == 'add' ? 'Add Budget' : 'Edit Budget');
            @this.budgetId = title == 'add' ? 0 : button.data('id');

            if (title == 'add') {
                @this.categoryId = '';
                @this.amount = '';
                @this.period = '';
                @this.note = '';
                @this.userUsername = '';
            } else {
                @this.categoryId = button.data('category');
                @this.amount = button.data('amount');
                @this.period = button.data('period');
                @this.note = button.data('note');
                @this.userUsername = button.data('user');
            }

            $('#confirmBudgetSave').click(function () {
                $('#budgetModal').modal('hide');
            });
        }); 
    </script>
@endsection