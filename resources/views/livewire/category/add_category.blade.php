<div>
    <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create category</h6>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" wire:model="name" class="form-control" id="name" placeholder="Enter name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select wire:model="type" class="form-control" id="type">
                                <option value="">Select type</option>
                                <option value="{{ CATEGORY_EXPENDITURE }}">Expenditure</option>
                                <option value="{{ CATEGORY_INCOME }}">Income</option>
                                <option value="{{ CATEGORY_OTHER }}">Other</option>
                            </select>
                            @error('type') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea wire:model="description" class="form-control" id="description" placeholder="Enter description" rows="10"></textarea>
                            @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('category') }}" class="btn btn-secondary mr-2">Return</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>