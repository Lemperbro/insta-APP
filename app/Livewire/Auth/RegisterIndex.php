<?php

namespace App\Livewire\Auth;

use Exception;
use App\Enums\RoleEnum;
use Livewire\Component;
use App\Models\Auth\User;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Log;
use App\Exceptions\HandledException;
use TallStackUi\Traits\Interactions;
#[Layout('components.layouts.auth')]
class RegisterIndex extends Component
{
    use Interactions;

    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $phone_number;
    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'phone_number' => 'required|string|min:8|max:15'
    ];
    public function render()
    {
        return view('livewire.auth.register-index');
    }

    public function register()
    {
        $this->validate();
        try {

            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => $this->password,
                'phone_number' => $this->phone_number,
            ]);
            $user->syncRoles(RoleEnum::USER->value);
            $this->toast()->success('Berhasil', 'Berhasil mendaftarkan akun , silahkan login untuk masuk kedalam sistem')->flash()->send();
            $this->redirect(route('auth.login'));
        } catch (Exception | HandledException $e) {
            Log::error($e->getMessage());
            $this->toast()->error('Gagal', $e instanceof HandledException ? $e->getMessage() : 'Terjadi kesalahan, silahkan coba lagi')->send();
        }
    }
}
