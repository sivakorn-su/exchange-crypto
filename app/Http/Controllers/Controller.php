<?php

namespace App\Http\Controllers;

use App\Http\Actions\SaveUser;
use App\Http\Requests\CreateRegisterRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function register(CreateRegisterRequest $registerRequest, SaveUser $saveUser)
    {
        $data = $registerRequest->validated();

        return $saveUser->execute($data);
    }
}
