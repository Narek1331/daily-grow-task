<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Get all users and filter by full_name, dob, phone_number.
     *
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsersFiltered(array $filters)
    {
        return $this->userRepository->filterUsers($filters);
    }

        /**
     * Create a new user.
     *
     * @param array $userData
     * @return User
     */
    public function createUser(array $userData)
    {
        return $this->userRepository->store($userData);
    }
}
