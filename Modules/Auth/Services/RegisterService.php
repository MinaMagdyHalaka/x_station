<?php

namespace Modules\Auth\Services;

use App\Models\User;

class RegisterService
{
    public User $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }
    public function register(array $data)
    {
        $user = $this->userModel::create($data);
        $token = $user->createToken("API TOKEN")->plainTextToken;
        $user->token = $token;
        return $user;
    }
}
