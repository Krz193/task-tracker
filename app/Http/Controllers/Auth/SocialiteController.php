<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;

class SocialiteController extends Controller
{
    public function redirectToDiscord()
    {
        return Socialite::driver('discord')->redirect();
    }

    public function handleDiscordCallback()
    {
        try {

            $discordUser = Socialite::driver('discord')->user();
            $user = User::where('discord_id', '=', $discordUser->getId())
            ->first();

            if(!$user) {
                $user = User::create([
                    'name' => $discordUser->getName(),
                    'email' => $discordUser->getEmail(),
                    'discord_id' => $discordUser->getId(),
                    'discord_avatar' => $discordUser->getAvatar(),
                    'discord_username' => $discordUser->getNickname() ?? $discordUser->getName(),
                    'discord_token' => $discordUser->token,
                    'discord_refresh_token' => $discordUser->refreshToken,
                    'discord_token_expires_at' => Carbon::now()->addSeconds($discordUser->expiresIn),
                    'password' => bcrypt(uniqid()), // dummy password
                ]);
            } else {
                // Update token info setiap login
                $user->update([
                    'discord_token' => $discordUser->token,
                    'discord_refresh_token' => $discordUser->refreshToken,
                    'discord_token_expires_at' => Carbon::now()->addSeconds($discordUser->expiresIn),
                ]);
            }

            Auth::login($user);

            return redirect()->route('dashboard');
            // dd($user); // sementara testing dulu
        } catch (InvalidStateException $e) {
            return redirect()->route('login')->with('error', 'Session expired. Please try again.');
        }
    }
}
