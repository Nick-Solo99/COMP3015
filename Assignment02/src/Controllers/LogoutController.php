<?php

namespace src\Controllers;

use core\Request;

class LogoutController extends Controller
{
    public function logout() : void
    {
        $this->destroySession();
        $this->redirect('/');
    }

}
