<?php

namespace App\Livewire\Partials\Panels\Headers;

use Exception;
use Livewire\Component;
use App\Models\Auth\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Exceptions\HandledException;
use Illuminate\Support\Facades\Auth;

class UserMenu extends Component
{
    public function render()
    {
        return view('livewire.partials.panels.headers.user-menu');
    }
    public function logout(){
        try{
            $user  = User::find(Auth::id());
            DB::transaction(function () use($user) { 
                $user->update([
                    'fcm_web_token' => null
                ]);
                Auth::logout(); 
            });
            $this->redirect(route('auth.login'));
        }catch(Exception $e){
            Log::error($e->getMessage());
        }catch(HandledException $e){
            Log::error($e->getMessage());
        }
    }
}
