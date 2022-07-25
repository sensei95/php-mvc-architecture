<?php

namespace App\Models;

class User extends Model
{

    protected string $table = 'users';

    /**
     * @param string $username
     * @return mixed
     */
    public function getByUsername(string $username): mixed
    {
        return $this->query("SELECT * FROM users WHERE username = ? LIMIT 1",[$username],true);
    }

}