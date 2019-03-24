<?php

/**
 * hash passwords
 */

namespace sp_n1_v3\Helpers;

class Hash
{
    protected $config;
    public function __construct($config)
    {
        $this->config = $config;
    }

    // the hasher
    public function password($password)
    {
        return password_hash(
            $password,
            $this->config->get("app.hash.algo"),
            [
                'cost' => $this->config->get("app.hash.cost"),
            ],
            );
    }

    // checks if given password hashed and the has from db are the same
    public function password_check($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function hash($input) {
        return hash('sha256', $input);
    }

    public function hash_check($known, $user) {
        return hash_equals($known, $user);
    }
}
