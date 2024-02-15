<?php

namespace App\Services;

use App\Repositories\AuthRepository;

class AuthService
{
    protected $authRepository;

    /**
     * Create a new instance of AuthService.
     *
     * @param  \App\Repositories\AuthRepository  $authRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Attempt to authenticate a user.
     *
     * @param  array  $credentials
     * @return string|null
     */
    public function attempt(array $credentials): ?string
    {
        $user = $this->authRepository->getByCredentials($credentials);

        if (!$user) {
            return null;
        }

        return $this->authRepository->createToken();
    }

    /**
     * Get the authenticated user.
     *
     * @return \App\Models\User|null
     */
    public function user()
    {
        return $this->authRepository->getUser();
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return void
     */
    public function logout(): void
    {
        $this->authRepository->invalidateToken();
    }

    /**
     * Refresh a token.
     *
     * @return string|null
     */
    public function refresh(): ?string
    {
        return $this->authRepository->createToken();
    }

    /**
     * Register a new user.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function register(array $data)
    {
        return $this->authRepository->createUser($data);
    }

    /**
     * Get the token TTL factory.
     *
     * @return \Illuminate\Auth\Passwords\TokenRepositoryInterface
     */
    public function factory()
    {
        return $this->authRepository->getTokenRepository();
    }
}
