<?php

namespace Modules\Auth\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\u;

class LoginService
{
    public User $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }
    public function login(array $data)
    {
        if (! Auth::attempt($data)){
            return false;
        }

        $user = User::where(['email'=> $data['email']])->first();
        $token = $user->createToken("API TOKEN")->plainTextToken;
        $user->token = $token;

        return $user;
    }
}
