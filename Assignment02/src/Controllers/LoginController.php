<?php

namespace src\Controllers;

use core\Request;
use src\Repositories\UserRepository;

class LoginController extends Controller
{
    /**
     * Show the login page.
     * @return void
     */
    public function index(Request $request): void
    {
        $this->startSession();
        if ($request->isGuest()) {
            $this->render('login', [], false);
            unset($_SESSION['email_error'], $_SESSION['email'], $_SESSION['password_error']);
            exit;
        } else {
            $this->redirect('/');
        }
    }

    /**
     * Process the login attempt.
     * @param Request $request
     * @return void
     */
    public function login(Request $request): void
    {
        $userRepository = new UserRepository();
        $email = $request->input('email');
        $account = $userRepository->getUserByEmail($email);
        $from = $request->input('from');
        if ($account === false) {
            Controller::setSessionData('email_error', 'Error! No account associated with this email.');
            Controller::setSessionData('email', $email);
            $this->redirect('/login?from=' . $from ?? '/');
        }
        if ($account && password_verify($request->input('password'), $account->password_digest)) {
            session_regenerate_id(true);
            Controller::setSessionData('user_id', $account->id);
            $this->redirect($from ?? '/');
        }
        Controller::setSessionData('password_error', 'Error! Wrong password.');
        Controller::setSessionData('email', $email);
        $this->redirect('/login?from=' . $from ?? '/');
    }

}
