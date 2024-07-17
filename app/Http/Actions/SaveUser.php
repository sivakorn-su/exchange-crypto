<?php

namespace App\Http\Actions;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class SaveUser
{

    public function execute(array $data): JsonResponse
    {
        Db::beginTransaction();
        try {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();
            Db::commit();
            return response()->json(['message' => 'User registered successfully']);
        } catch (Exception $e) {
            Db::rollBack();
            throw $e;
        }

    }
}
