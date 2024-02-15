<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository
{
    /**
     * Get the authenticated user by their credentials.
     *
     * @param  array  $credentials
     * @return \App\Models\User|null
     */
    public function getByCredentials(array $credentials): ?User
    {
        if (!auth()->attempt($credentials)) {
            return null;
        }

        return auth()->user();
    }

    /**
     * Create a new token for the authenticated user.
     *
     * @return string|null
     */
    public function createToken(): ?string
    {
        return auth()->user()->createToken('Personal Access Token')->plainTextToken;
    }

    /**
     * Invalidate the current user's token (logout).
     *
     * @return void
     */
    public function invalidateToken(): void
    {
        // auth()->user()->currentAccessToken()->delete();
        auth()->logout();
    }

    /**
     * Create a new user.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function createUser(array $data): User
    {
        return User::create([
            'full_name' => $data['full_name'],
            'dob' => $data['dob'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Get the token TTL factory.
     *
     * @return \Illuminate\Auth\Passwords\TokenRepositoryInterface
     */
    public function getTokenRepository()
    {
        return Auth::user()->tokens();
    }
}
