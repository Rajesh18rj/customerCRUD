<div class="card offset-3 col-6">
    <div class="card-header">
        Create Customer
    </div>
    <div class="card-body">
        <form wire:submit.prevent="save">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Name</label>
                <input wire:model="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div>
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input wire:model="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div>
                    @error('email')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Phone</label>
                <input wire:model="phone" type="text" class="form-control" id="exampleInputPassword1">
                <div>
                    @error('phone')
                    <span>{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>

        </form>
    </div>
</div>
