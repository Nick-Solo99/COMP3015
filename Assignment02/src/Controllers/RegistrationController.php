<?php

namespace src\Controllers;

use core\Request;
use PDOException;
use src\Repositories\UserRepository;

class RegistrationController extends Controller
{
    /**
     * Show the /register page.
     */
    public function index(Request $request): void
    {
        $this->startSession();
        if ($request->isGuest())
        {
            $this->render('register', [],false);
            unset($_SESSION['name_error'], $_SESSION['name'], $_SESSION['email_error'], $_SESSION['email'], $_SESSION['password_error']);
            exit;
        } else {
            $this->redirect('/');
        }
    }

    /**
     * Handle the registration of a new user.
     */
    public function register(Request $request): void
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $userRepository = new UserRepository();
        $account = $userRepository->getUserByEmail($request->input('email'));
        $password = $request->input('password');
        $passwordRegex = '/^(?=.*?[a-zA-Z0-9#?!@$%^&*-])(?=.*?[#?!@$%^&*-])(?!.*\s).{8,}$/';

        if (empty(trim($name))) {
            Controller::setSessionData('name_error', 'true');
            if (!empty($email)) {
                Controller::setSessionData('email', $email);
            }
            $this->redirect('/register');
        }


        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Controller::setSessionData('email_error', 'Error! Invalid email provided.');
            Controller::setSessionData('email', $email);
            Controller::setSessionData('name', $name);
            $this->redirect('/register');
        }

        if ($account !== false) {
            Controller::setSessionData('email_error', 'Error! Provided Email is already associated with another account.');
            Controller::setSessionData('email', $email);
            Controller::setSessionData('name', $name);
            $this->redirect('/register');
        }


        if (!preg_match($passwordRegex, $password)) {
            Controller::setSessionData('password_error', 'true');
            Controller::setSessionData('email', $email);
            Controller::setSessionData('name', $name);
            $this->redirect('/register');
        }

        $digest = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
        $user = $userRepository->saveUser($name, $email, $digest);
        if ($user !== false) {
            session_regenerate_id(true);
            Controller::setSessionData('user_id', $user->id);
        }
        $this->redirect('/');


        Controller::setSessionData('email_error', 'Error! Provided Email is already associated with another account.');
        Controller::setSessionData('email', $email);
        Controller::setSessionData('name', $name);
        $this->redirect('/register');
    }

}
