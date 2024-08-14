<!-- Tag Modal -->
<div class="modal fade" id="tagModal" tabindex="-1" role="dialog" aria-labelledby="tagTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tagTitle"></h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form wire:submit.prevent="save">
                <div class="modal-body">
                    <input type="hidden" id="tagId" wire:model.live="tagId">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" wire:model="name">
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" class="form-control" wire:model="code">
                                @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" wire:model="description" rows="5"></textarea>
                                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="confirmTagSave" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('script')
    <script>
        $('#tagModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var modal = $(this);
            modal.find('.modal-title').text(title == 'add' ? 'Add Tag' : 'Edit Tag: ' + button.data('name'));
            @this.tagId = title == 'add' ? 0 : button.data('id');

            if (title == 'add') {
                @this.name = '';
                @this.code = '';
                @this.description = '';
            } else {
                @this.name = button.data('name');
                @this.code = button.data('code');
                @this.description = button.data('description');
            }

            $('#confirmTagSave').click(function () {
                $('#tagModal').modal('hide');
            });
        }); 
    </script>
@endsection