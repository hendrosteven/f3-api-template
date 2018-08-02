<?php

class PasswordHash {

    static function hashing($plain){
        $options = [
            'cost' => 12,
        ];
        return password_hash($plain, PASSWORD_BCRYPT, $options);
    }

    static function verifying($plain, $hash){
        return password_verify($plain, $hash);
    }
}