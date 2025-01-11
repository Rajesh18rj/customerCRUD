# 1

create layout 

go to layout file (app.blade)

register the bs cdn

then create component named 'CreateCustomer'

then going to Route and register this livewire .. 

then go to bootstrap page -> Go to the Card section , copy one of the card and paste it in create-customer blade file 

then go to bs Form section copy and paste the form code inside of the card .. 

then make some changes in form that form fields are name, email, phone 

then come to class file declare the public property name, email and phone

then create a save function .. 

    public function save(){
        dd('Hey I am from Save');
    }

we want to check this save function is triggered or not thats why we did dd.. 

then add this in form tag         <form wire:click.prevent="save">

now its working perfectly.. 

so lets write the save function

before that assign the wire:model="" in name, email , phone's input field

lets back to save method 

first we are going to validate (becoz never trust end user)

        //validate
        $validated= $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|unique:customers',

after validation ,then we are going to create the customer

        //create
        Customer::create($validated);

we dont have this Customer Model lets create one with migration

go to the migration and add these name, email, phone fields and goto model give protected_guarded=[]

the migrate it.. 

then namma validation write pannom la athuku font-end la validation error ah show panra mari , error message ah kuduthukulam ..


                <div>
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

ithey mari email and phone ku error directory write panrom.. 

then we submit without filling the input fields it shows validation error .. 

that's it .. 

# 2

Display all customers

then create 'Customers' livewire component for displaying customers

before that we need table for showing that .. so go and bs docs page copy the first table code and paste in Customers blade file 

then go to route , we need a route so assign the route... Route::get('/customers', \App\Livewire\Customers::class);


    @foreach($customers as $customer)
        <tr>
            <th scope="row">{{ $customer->id }}</th>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>
            <td>
                <button class="btn btn-primary btn-sm">View</button>
                <button class="btn btn-secondary btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm">Delete</button>
            </td>
        </tr>
    @endforeach

then loop this in blade file, 

then goto class file , pass the key there

,['customers' => Customer::all()]

just like this .. now go to customers url , you can see the customer details 

thats it .. 




