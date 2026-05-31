<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect the user to the OAuth provider.
     */
    public function redirect(string $provider)
    {
        $this->validateProvider($provider);
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Handle the callback from the OAuth provider.
     */
    public function callback(string $provider)
    {
        $this->validateProvider($provider);

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            \Log::error('Socialite Login Error: ' . $e->getMessage(), ['exception' => $e]);
            return redirect()->route('login')->withErrors(['social' => 'Gagal login dengan ' . ucfirst($provider) . '. Silakan coba lagi.']);
        }

        // Find existing user by provider_id, or by email
        $user = User::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if (!$user) {
            // Check if user already registered with this email
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                // Link social account to existing user
                $user->update([
                    'provider'       => $provider,
                    'provider_id'    => $socialUser->getId(),
                    'provider_token' => $socialUser->token ?? null,
                    'avatar'         => $socialUser->getAvatar(),
                ]);
            } else {
                // Create new user
                $user = User::create([
                    'name'           => $socialUser->getName() ?? $socialUser->getNickname() ?? 'User',
                    'email'          => $socialUser->getEmail(),
                    'password'       => bcrypt(\Illuminate\Support\Str::random(24)),
                    'provider'       => $provider,
                    'provider_id'    => $socialUser->getId(),
                    'provider_token' => $socialUser->token ?? null,
                    'avatar'         => $socialUser->getAvatar(),
                    'email_verified_at' => now(),
                ]);
            }
        }

        Auth::login($user, true);

        return redirect()->intended('/');
    }

    private function validateProvider(string $provider): void
    {
        if (!in_array($provider, ['google'])) {
            abort(404);
        }
    }
}
