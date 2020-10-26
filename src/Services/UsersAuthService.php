<?php

namespace Services;

use models\users\User;

class UsersAuthService
{
    public static function createToken(User $user)
    {
        $token = $user->getId() . ':' . $user->getAuthToken();
        setcookie('token', $token, 0, '/', '', false, true);
    }

    public static function getUserByToken()
    {
        $token = $_COOKIE['token'] ?? '';

        if (empty($token)) {
            return null;
        }

        $logUser = explode(':', $token, 2);

        $userId = $logUser[0];
        $authToken = $logUser[1];

        $user = User::getById($userId);

        if ($user === null) {
            return null;
        }

        if ($user->getAuthToken() !== $authToken) {
            return null;
        }
        return $user;
    }

}