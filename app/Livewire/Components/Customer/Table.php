<?php

namespace App\Livewire\Components\Customer;

use Livewire\Component;
use Livewire\Attributes\On;

class Table extends Component
{
    public function openModal()
    {
        $this->dispatch('open-modal');
    }

    #[On('success')]
    public function messageSuccess($message)
    {
        session()->flash('success', $message);
    }

    public function render()
    {
        return view('livewire.components.customer.table');
    }
}
