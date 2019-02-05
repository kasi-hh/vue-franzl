<?php
/**
 * Created by PhpStorm.
 * User: kasi
 * Date: 31.01.2019
 * Time: 12:24
 */

namespace App\Lib;


class Security {
    public static function createPasswordHash(string $password):string{
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function verifyPassword(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }
    public static function isValidPassword(string $password): bool {
        return strlen(trim($password)) > 5;
    }

}