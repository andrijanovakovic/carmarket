<?php

/**
 * `User` model here for `user` table
 */

namespace sp_n1_v3\User;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{
    protected $table = 'user';

    protected $fillable = [
        'username',
        'password',
        'email',
        'active_hash',
        'recover_hash',
        'active_record',
        'remember_identifier',
        'remember_token',
    ];

    public function get_username() {
        return "{$this->username}";
    }
    
    public function get_email() {
        return "{$this->email}";
    }

    public function activate_account() {
        $this->update([
            'active_record' => 1,
            'active_hash' => null,
        ]);
    }

    public function update_remember_credentials($remember_identifier, $remember_token) {
        $this->update([
            'remember_identifier' => $remember_identifier,
            'remember_token' => $remember_token,
        ]);
    }

    public function remove_remember_credentials() {
        $this->update_remember_credentials(null, null);
    }
}
