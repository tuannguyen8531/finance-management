<div>
    <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Create user</h6>
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
                            <label for="username">Username</label>
                            <input type="text" wire:model="username" class="form-control" id="username" placeholder="Enter username">
                            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" wire:model="email" class="form-control" id="email" placeholder="Enter email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="balance">Balance</label>
                            <input type="number" min="0" wire:model="balance" class="form-control" id="balance" placeholder="Enter balance">
                            @error('balance') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" wire:model="password" class="form-control" id="password" placeholder="Enter password">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="text-right">
                    <a href="{{ route('user') }}" class="btn btn-secondary mr-2">Return</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>              
</div>