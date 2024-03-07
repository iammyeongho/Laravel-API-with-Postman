<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class UserController extends Controller
{
    public function kakaologin(Request $request)
    {
        try{
            $user = Socialite::driver('kakao')->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->user();
        } catch(InvalidStateException $e) {
            $user = Socialite::driver('kakao')->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->stateless()->user();
        }

        dd($user);
        
        // $userEmail = $user->email;
        
        // $result = User::where('UserEmail', $userEmail)->first();

        
    }
}
