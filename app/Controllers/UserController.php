<?php

namespace App\Controllers;

use App\Models\User;
use App\Validation\Validator;

class UserController extends Controller
{
    public function login()
    {
        return $this->view('auth.login');
    }

    public function authenticate()
    {

        $this->validateData($_POST);

        $user = (new User($this->getDB()))->getByUsername($_POST['username']);

        if($user){
            if($this->verifyPassword($_POST['password'], $user->password)){
                $this->createUserSession($user);
                return header("Location: /admin/posts?success=true");
            }
        }

        $_SESSION['errors']['username'] = ['password ou username incorrect'];
        header("Location: /login");
        exit();

    }

    public function createUserSession(User $user): void
    {
        $_SESSION['auth'] = (int) $user->is_admin;
        $_SESSION['errors'] = [];
    }

    public function validateData(array $data): void
    {
        $errors =  (new Validator($data))->validate([
            'username' => ['required','string','min:5'],
            'password' => ['required','string','min:5']
        ]);

        if (!empty($errors)){
            $_SESSION['errors'] = $errors;
            header("Location: /login");
            exit;
        }
    }

    /**
     * @param string $givenPassword
     * @param string $hashedPassword
     * @return bool
     */
    public function verifyPassword(string $givenPassword, string $hashedPassword): bool
    {
        return password_verify($givenPassword, $hashedPassword);
    }

    public function logout()
    {
        session_destroy();

        return header("Location: /login");
    }
}