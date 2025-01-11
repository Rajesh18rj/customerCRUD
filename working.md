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

# 3 

show single customer

first uh enna panna porom naa.. antha table ku mela oru button vachu , antha button ah click panna navigate aagi customer/create route ku pora mathiri pana porom..

    <div>
    <button
        class="btn btn-success btn-sm"
        wire:navigate
        href="/customers/create"
    >Create</button>
    ..
    </div>

then antha customer create page la submit pakkathula back nu oru button vachu , back click panna again '/customers' route ke vara mari panna porom..

       <button wire:navigate href="/customers" class="btn btn-secondary">Back</button>

ok lets working on view button , 

what we are going to do is when i click view button its shows a card that should contains customer details 

go to view button

     <button wire:navigate href="/customers/{{$customer->id}}" class="btn btn-primary btn-sm">View</button> 
inga id pass panrom becoz oru particular customer ah than view panna porom, thats why 

then create a livewire component for view -'ViewCustomer'

then tell this in route ..
    Route::get('/customers/{customer}', ViewCustomer::class);

now go to ViewCustomer

    public $customer;
    public function mount(Customer $customer){
        $this->customer = $customer;
    }

then go to view file , we need a card code to show the customer detail , so get that in bs docs

paste it in blade file and change the columns using $customer key we passed in class file

after viewing we want the back button there to comeback to customers , so 

        <a wire:navigate href="/customers" class="btn btn-secondary">Back</a>

that's it .. 

# 4

today we are working on edit customer 

first going to edit button 

    <button wire:navigate href="/customers/{{$customer->id}}/edit" class="btn btn-secondary btn-sm">Edit</button>

then we need to apply this in route

Route::get('/customers/{customer}/edit', EditCustomer::class);  -> we should create this Component 

then go to EditCustomer Component, this form form more similar like create-customer 

so copy that code and paste it here.. change the form tag        
    <form wire:submit="updateCustomer"> we later create this method (updateCustomer) in class file 


then go

    public $customer;
    public $name;
    public $email;
    public $phone;

    public function mount(Customer $customer){
        $this->customer = $customer;
        $this->name=$customer->name;
        $this->email=$customer->email;
        $this->phone=$customer->phone;
    }

this is same like passing the id in mount .. this method is happens like a magic 

 the create la epdi save function yeluthunammo , athey mari edit la update ku function yelutha porom.. 

    public function updateCustomer(){
        $validated = $this->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|',
        'phone' => 'required|',
    ]);

        $this->customer->update($validated);

 save la epdi validate panni save pannamo athey mari update pannumbothum validate panni than update pannanum.. 

then update aanathuku aprom flash message , customer page la vantha nallarukum ..so 

      session()->flash('success', 'Customer Updated successfully.');
        return $this->redirect('/customers', navigate:true);

intha flash message enga varanum naa.. update pannathum customer page la table ku mela varanum.. so 

athuku munnadi intha flash message ah oru component la store pannitaa , atha enga venumnaalum call panni use panikalam, so

> php artisan make:livewire flash-message

    <div>
        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session('success')}}
            </div>
        @endif
    </div>

then customer blade file ku poi , top la itha call panalam

<livewire:flash-message/>

just like this .. 

thats it .. 

# 5 

delete customer 

                <button wire:click="deleteCustomer({{ $customer->id }})" class="btn btn-danger btn-sm">Delete</button>
add this in delete button

then lets go to customer class file 

    public function deleteCustomer(Customer $customer){
        $customer->delete();
       
    }

we already see this method , instead of passing id 

then if we want can add flash message

    session()->flash('success', 'Customer Deleted successfully.');
    return $this->redirect('/customers', navigate:true);

thats it .. 







