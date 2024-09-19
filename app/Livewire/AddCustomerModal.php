<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Session;


class AddCustomerModal extends Component
{
    public $name;
    public $number_phone;

    protected $rules = [
        'name' => 'required|string|max:255',
        'number_phone' => 'required|numeric|unique:customers,number_phone',
    ];

    public function submit()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'number_phone' => $this->number_phone,
        ]);

        Session::flash('message', 'Customer berhasil ditambahkan.');
        $this->emit('customerAdded'); // Emit event ketika customer berhasil ditambahkan
        $this->dispatchBrowserEvent('close-modal'); // Menutup modal setelah submit
    }

    public function render()
    {
        return view('livewire.add-customer-modal');
    }
}
