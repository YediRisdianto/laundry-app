<?php

namespace App\Livewire\Components\Customer;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Customer;

class Table extends Component
{

    use WithPagination, WithoutUrlPagination;

    public $search;

    public function openModal()
    {
        $this->dispatch('open-modal');
    }

    #[On('success')]
    public function messageSuccess($message)
    {
        $this->resetPage();
        session()->flash('success', $message);
    }

    public function getItems()
    {
        return Customer::where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('phone_number', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('address', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    }

    public function render()
    {
        return view('livewire.components.customer.table', [
            'customers' => $this->getItems()
        ]);
    }
}
