<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Mockery\Exception;
use App\Models\User;
class GithubAuthController extends Controller
{
    public function github_redirect(){
        return Socialite::driver('github')->redirect();
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
