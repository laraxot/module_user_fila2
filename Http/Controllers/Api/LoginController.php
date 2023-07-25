<?php

declare(strict_types=1);

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Xot\Http\Controllers\XotBaseController;

class LoginController extends XotBaseController {
    /**
     * Login api
     */
    public function __invoke(Request $request): JsonResponse {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['name'] = $user->name;

            return $this->sendResponse('User login successfully.', $success);
        } else {
            return $this->sendError('Unauthorised.', ['error' => 'Unauthorised']);
        }
    }
}
