<?php

namespace sp_n1_v3\Validation;

use Violin\Violin;
use sp_n1_v3\User\User;

class Validator extends Violin
{
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->addFieldMessages([
            'email' => [
                'uniqueEmail' => 'That email is already in use.',
            ],
            'username' => [
                'uniqueUsername' => 'That username is already in use.'
            ]
        ]);
    }

    // checks if given email is already in use or not
    public function validate_uniqueEmail($value, $input, $args)
    {
        $user = $this->user->where('email', $value);
        if ($user->count()) {
            return false;
        }
        return true;
    }

    // checks if given username is already in use or not
    public function validate_uniqueUsername($value, $input, $args)
    {
        $user = $this->user->where('username', $value);
        if ($user->count()) {
            return false;
        }
        return true;
    }
}
