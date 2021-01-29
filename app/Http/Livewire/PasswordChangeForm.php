<?php

namespace App\Http\Livewire;

use App\Actions\Fortify\UpdateUserPassword;
use Livewire\Component;

class PasswordChangeForm extends Component
{
    public $state = [
        'current_password' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function changePassword(UpdateUserPassword $updater)
    {
        $this->resetErrorBag();

        $updater->update(auth()->user(), $this->state);

        $this->state = [
            'current_password' => '',
            'password' => '',
            'password_confirmation' => '',
        ];

        session()->flash('status', 'Password successfully changed');
    }

    public function render()
    {
        return view('livewire.password-change-form');
    }
}
