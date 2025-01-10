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



