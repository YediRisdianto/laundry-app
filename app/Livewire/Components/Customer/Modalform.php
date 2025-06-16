<?php

namespace App\Livewire\Components\Customer;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Customer;

class Modalform extends Component
{

    public $modalFormData = false;

    public $name;
    public $email;
    public $phone_number;
    public $address;

    #[On('open-modal')] 
    public function openModal()
    {
        $this->modalFormData = true;
    }

    public function closeModal()
    {
        $this->modalFormData = false;
    }

    public function save()
    {
        // dd($this->name, $this->email, $this->phone_number, $this->address);

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email:rfc,dns|max:255',
            'phone_number' => ['required', 'regex:/^\+?[0-9]{9,15}$/'],
            'address' => 'required|string|max:255',
        ]);

        $customer = Customer::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'address' => $this->address
        ]);

        $this->closeModal();
        $this->dispatch('success', message: 'Customer Created Successfully');
        // session()->flash('success','Customer Created Successfully');
    }

    public function render()
    {
        return view('livewire.components.customer.modalform');
    }
}
