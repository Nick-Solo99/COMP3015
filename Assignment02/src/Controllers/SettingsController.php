<?php

namespace src\Controllers;

use core\Request;
use src\Repositories\UserRepository;

class SettingsController extends Controller
{
    /**
     * Show the /settings page
     */
    public function index(Request $request): void
    {
        $this->startSession();
        $id = $request->input('id');
        if ($request->isAuthenticated()) {
            if ($request->input('id') != Controller::getSessionData('user_id')) {
                $this->redirect('/settings?id=' . Controller::getSessionData('user_id'));
            }
            $this->render("settings", [], false);
            unset($_SESSION['name_error'], $_SESSION['upload_error']);
            exit;
        } else {
            $this->redirect('/login?from=/settings');
        }
    }

    /**
     * Process the update for a user
     */
    public function update(Request $request): void
    {
        $userRepository = new UserRepository();
        $id = $request->input('id');
        $name = $request->input('name');
        if ($request->isAuthenticated() && $id && $id == Controller::getSessionData('user_id')) {

            if (empty(trim($name))) {
                Controller::setSessionData('name_error', 'Error! Name cannot be empty.');
                $this->redirect('/settings?id=' . Controller::getSessionData('user_id'));
            }

            if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['img'];
                $fileTempPath = $file['tmp_name'];
                $fileName = $file['name'];
                $fileInfo = pathinfo($fileName);
                $fileExt = $fileInfo['extension'];
                $allowedExtensions = array("jpg", "jpeg", "png", "gif", "webp");
                if (in_array($fileExt, $allowedExtensions)) {
                    $newFileName = 'user' . Controller::getSessionData('user_id') . 'Img.' . $fileExt;

                    $uploadDir = __DIR__ . '/../../public/images/' . $newFileName;

                    move_uploaded_file($fileTempPath, $uploadDir);

                    $userRepository->updateUser($id, $name, $newFileName);
                    $this->redirect('/settings?id=' . Controller::getSessionData('user_id'));
                }
                Controller::setSessionData('upload_error', 'Error! Invalid File Type Provided.');
                $this->redirect('/settings?id=' . Controller::getSessionData('user_id'));
            }

            if (!empty(trim($name))) {
                $userRepository->updateUser($id, $name);
                $this->redirect('/settings?id=' . Controller::getSessionData('user_id'));
            }
        }
        $this->redirect("/login?from=/settings");
    }
}
