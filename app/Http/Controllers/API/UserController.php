<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

     /**
     * Get all users and filter by full_name, dob, phone_number.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $filters = $request->only(['full_name', 'dob', 'phone_number']);
        $users = $this->userService->getAllUsersFiltered($filters);

        return response()->json([
            'status' => true,
            'data' => UserResource::collection($users)
        ],200);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUserRequest $request)
    {
        // Validate incoming request data using StoreUserRequest
        $validatedData = $request->validated();

        // Create new user using UserService
        $user = $this->userService->createUser($validatedData);

        return response()->json([
            'status' => true,
            'message' => 'User created successfully.',
            'data' => new UserResource($user)
        ], 201);
    }
}
