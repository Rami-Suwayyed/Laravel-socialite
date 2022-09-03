<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Throwable;

class SocialiteloginController extends Controller
{



    public function redirect($provider){
        return Socialite::driver($provider)->redirect();
    }


    public function collback($provider){

        try{
        $uesr_provider = Socialite::driver($provider)->user();

        $uesr= User::where([
            'provider'=>$provider,
            'provider_id'=>$uesr_provider->id
        ])->first();
        if(!$uesr){
        $uesr = User::create([
            'name'   =>$uesr_provider->name,
            'email'  =>$uesr_provider->email,
            'password'   => Hash::make(Str::random(8)),
            'provider'   =>$provider,
            'provider_id'   =>$uesr_provider->id,
            'provider_token'   =>$uesr_provider->token,
        ]);
    }
    Auth::login($uesr);

    return redirect()->route('dashboard');

    }catch(Throwable $e){
        return redirect()->route('login')->withErrors([
            'message'=>$e->getMessage(),]
        );
    }
    }
}
