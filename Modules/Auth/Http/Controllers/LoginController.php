<?php

namespace Modules\Auth\Http\Controllers;

use App\Traits\HttpResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\LoginRequest;
use Modules\Auth\Services\LoginService;

class LoginController extends Controller
{
    use HttpResponse;
    public function __construct(private readonly LoginService $loginService)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {

        $result = $this->loginService->login($request->validated());
        if (! $result){
            return $this->validationErrorsResponse(message: translate_word('wrong_credentials'));
        }
        return $this->okResponse($result, message: translate_success_message('user', 'logged_in'));
    }

}
