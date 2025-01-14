<div>
    <div class="row">
        <div class="col-auto">
            <button
                class="btn btn-success btn-sm"
                wire:navigate
                href="/customers/create"
            >Create</button>
        </div>
        <div class="col-auto">
            <input wire:model.live.debounce.150ms="search" type="text" class="form-control" placeholder="search customers">
        </div>
    </div>

<livewire:flash-message/>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Action</th>

    </tr>
    </thead>
    <tbody>

    @foreach($customers as $customer)
        <tr>
            <th scope="row">{{ $customer->id }}</th>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            <td>
                <button wire:navigate href="/customers/{{$customer->id}}" class="btn btn-primary btn-sm">View</button>
                <button wire:navigate href="/customers/{{$customer->id}}/edit" class="btn btn-secondary btn-sm">Edit</button>
                <button wire:click="deleteCustomer({{ $customer->id }})" class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
</div>
