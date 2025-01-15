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

# 6 

in this epi we are going to see registering a user

create a Register Livewire component

first go to Register class file 

    public $name;
    public $email;
    public $password;

assign these public properties first 

the create storeUser function.. 

    public function storeUser(){
    $validated = $this->validate([
    'name' => 'required',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:8',
    ]);

        //after validate the User we are going to save that user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        // after save the user , we need to login that user
        Auth::login($user);

        session()->flash('success', 'Registration successful!');

        //after login we need to redirect to the customers
        return $this->redirect('/customers', navigate:true);
    }

we need to represent these fields in Register form so we need a form code , so go in bootstrap and take form code and paste it blade file
assign the fields in form tag and name, email, password

then we need a route for register .. 

Route::get('register', Register::class);

then end of the form use this .. 
            <div class="mb-3">
                Already have an account ? <button wire:navigate href="/login" class="btn btn-success btn-sm">Login </button>
            </div>
this login url not working , now we working on this later

then we are going to group these in single auth route 

    Route::middleware('auth')->group(function () {
                                                                                                                                                                                                                                                              
    Route::get('/customers/create', CreateCustomer::class);
    Route::get('/customers', Customers::class);
    Route::get('/customers/{customer}', ViewCustomer::class);
    Route::get('/customers/{customer}/edit', EditCustomer::class);
});

becoz we want to show these routes , only the user is auth user 

that's it .. 

# 7 

we are working on login

first we are going to create a navbar Component

go to BS docs find the one navbar code 

in that navbar we can have Login , register , customers and logout 

login and register only shown to guest users .. give that with in the @guest directive

then customers and logout should be within @auth directive , becoz auth users only access these pages
we should define the wire:navigate and href.

then goto class file and define that logout method
    
    public function logout(Request $request){
           Auth::logout();
           $request->session()->invalidate();
           $request->session()->regenerateToken();
           return $this->redirect('login', navigate: true);
        }

then we should create a login component 

then copy and paste the register blade function into it .. and remove the name column 
then change the form wire:submit method --> loginUser()

we are going to create that loginUser Method in class file 

first define the email and password property 

then 

    public function loginUser(Request $request){
        $validated = $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        //if the password matches email we are allow the user to login
        if(Auth::attempt($validated)){
            $request->session()->regenerate();

            return $this->redirect('/customers', navigate: true);
        }
        //if the password did not match to that email
        $this->addError('email', 'The Password provided is incorrect.');
    }

then create a route for this 

    Route::get('/login', Login::class)->name('login');
that's it .. 

# 8 
today we are going to working on search 

create the search input field in customers blade file under the create customer 

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

then go to class file 

    if(! $this->search){
        $this->customers = Customer::all();
    }
    else{
        $this->customers= Customer::where('name', 'like', '%'.$this->search.'%')->get();
    }

write this in class file .. we are going to search by name thats why we write like this .. 

# 9

pagination

    use WithPagination

    if(! $this->search){
        $customers = Customer::paginate(2);
    }
    else{
        $customers = Customer::where('name', 'like', '%'.$this->search.'%')->paginate(2);
    }

{{ $customers->links() }}









