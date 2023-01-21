<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Mockery\Exception;
use App\Models\User;
class GoogleAuthController extends Controller
{
    public function google_redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function github_redirect(){
        return Socialite::driver('github')->redirect();
    }
    public function google_callback(){
        try
        {
            $GoogleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('google_id', $GoogleUser->id)->first();
//            dd($GoogleUser);
            if($user){
                Auth::login($user);
                return redirect('/');
            }
            else
            {
                $NewUser = User::create([
                    'name' => $GoogleUser->name,
                    'email' => $GoogleUser->email,
                    'google_id' => $GoogleUser->id,
                    'password' => bcrypt('23456'),
                ]);
                Auth::login($NewUser);
                return redirect('/');
            }
        }
        catch (Exception $exception){
            dd($exception->getMessage());
        }
    }
    public function github_callback(){
        try
        {
            $GitHubUser = Socialite::driver('github')->stateless()->user();
            $user = User::where('github_id', $GitHubUser->id)->first();
//            dd($GoogleUser);
            if($user){
                Auth::login($user);
                return redirect('/');
            }
            else
            {
                $NewUser = User::create([
                    'name' => $GitHubUser->name,
                    'email' => $GitHubUser->email,
                    'github_id' => $GitHubUser->id,
                    'password' => bcrypt('23456'),
                ]);
                Auth::login($NewUser);
                return redirect('/');
            }
        }
        catch (Exception $exception){
            dd($exception->getMessage());
        }
    }

}
