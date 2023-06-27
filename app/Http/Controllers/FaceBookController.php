<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Contracts\User as SocialiteUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class FaceBookController extends Controller
{
    /**
     * Login Using Facebook
     */
    public function loginUsingFacebook()
    {
        return Socialite::driver('facebook')->stateless()->redirect();
    }


    public function callbackFromFacebook()
    {
        try {
            $socialiteUser = Socialite::driver('facebook')->stateless()->user();

            $user = User::query()

                ->firstOrCreate(
                    [
                        'facebook_id' => $socialiteUser->id,
                    ],
                    [

                        'email' => $socialiteUser->email,
                        'name' => $socialiteUser->name,
                        'facebook_id' => $socialiteUser->id,
                        'avatar' => $socialiteUser->avatar,
                        'password' => Hash::make('vainho123')

                    ]
                );

            $token = Auth::login($user);

            return response()->json([
                'user' =>  $user,
                'jwt_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
