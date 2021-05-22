<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
* Columns in the table Books
*
* @property string $isbn
* @property string $author
* @property string $title
* @property string $picture
*/
class Users extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function getAllUsers()
    {
        $users = [];

        foreach (Users::all() as $user) {
            array_push($users, [
                'username' => $user->username,
                'password' => $user->password
            ]);
        }

        return $users;
    }

    public function getUserData($username)
    {
        $users = [];

        foreach (Users::all() as $user) {
            if ($user['username'] === $username) {
                array_push($users, [
                    'username' => $user->username,
                    'coins' => $user->coins
                ]);
            }
        }

        return $users;
    }


    public function checkUser($login)
    {
        $users = $this->getAllUsers();

        foreach ($users as $user) {
            if ($user['username'] === $login[0] && $user['password'] === $login[1]) {
                return true;
            }
        }

        return false;
    }

    public function checkUsername($username)
    {
        foreach (Users::all() as $user) {
            if ($username === $user->username) {
                return false;
            }
        }

        return true;
    }
}
