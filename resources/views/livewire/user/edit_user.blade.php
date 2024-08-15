<div>
    <h1 class="h3 mb-4 text-gray-800">{{ __('form.edit_user') }}</h1>

    @if (Session::has('message'))
        <div id="alert-message" class="alert alert-{{ Session::get('status') }}" role="alert">
            {{ Session::get('message') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User detail</h6>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="save">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" wire:model="name" class="form-control" id="name" value="{{ $user->name }}">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" wire:model="username" class="form-control" id="username" name="username">
                            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" wire:model="email" class="form-control" id="email" name="email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="balance">Balance</label>
                            <input type="number" min="0" wire:model="balance" class="form-control" id="balance" name="balance">
                            @error('balance') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <h6 class="pt-3"><b>Change Password</b></h6>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" wire:model="password" class="form-control" id="password" name="password">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="newPassword">New Password</label>
                            <input type="password" wire:model="newPassword" class="form-control" id="newPassword" name="newPassword">
                            @error('newPassword') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" wire:model="confirmPassword" class="form-control" id="confirmPassword" name="confirmPassword">
                            @error('confirmPassword') <span class="text-danger">{{ $message }}</span> @enderror
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