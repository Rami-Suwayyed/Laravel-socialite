<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function index($provider)
   {
    # code...
    $user= Auth::user();

    $uesr_provider = Socialite::driver($provider)->userFromToken($user->provider_token);
    dd($uesr_provider);
   }
}

