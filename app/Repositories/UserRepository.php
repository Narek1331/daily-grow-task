<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Filter users by full_name, dob, phone_number.
     *
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function filterUsers(array $filters)
    {
        $query = $this->model->query();

        foreach ($filters as $key => $value) {
            if ($value !== null) {
                // Check if the filter key is full_name, dob, or phone_number
                if (in_array($key, ['full_name', 'dob', 'phone_number'])) {
                    // If the key is one of the specified fields, perform a normal where clause
                    $query->where($key, 'like', '%' . $value . '%');
                } else {
                    // If the key is not one of the specified fields, use a 'like' clause
                    $query->orWhere($key, 'like', '%' . $value . '%');
                }
            }
        }

        return $query->get();
    }

      /**
     * Store a new user in the database.
     *
     * @param array $userData
     * @return User
     */
    public function store(array $userData)
    {
        return $this->model->create($userData);
    }


}
