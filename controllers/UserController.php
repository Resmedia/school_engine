<?php


namespace app\controllers;

use app\models\repositories\UserRepository;
use app\models\entities\User;

class UserController extends Controller
{
    public function actionLogin()
    {
        $repo = new UserRepository();
        
        $email =  $this->request->post('email');
        $password = $this->request->post('password');

        $email = strip_tags(stripslashes($email));
        $email = preg_replace('/\s+/', '', $email);

        if($email && $password) {
            if(!$repo->isValidEmail($email)) {
                $error = [
                    'message' => User::ERRORS['email_error'],
                    'status' => false,
                ];
                echo json_encode($error);
                return false;
            }

            if(!!$repo->isValidPassword($password)){
                $error = [
                    'message' => User::ERRORS['password_error'],
                    'status' => false,
                ];
                echo json_encode($error);
                return false;
            }

            $user = $repo->getWhere('email', $email);

            if ($user) {
                if (password_verify($password, $user->password_hash)) {
                    $hash = $repo->setDefaultHash(11, $email);
                    $this->session->setValue([
                        'email' => $email,
                        'id' => $user->id
                    ]);
                    $result = [
                        'hash' => $hash,
                        'status' => true,
                    ];
                    echo json_encode($result);
                    return true;
                }
                $error = [
                    'message' =>  User::ERRORS['password_user_error'],
                    'status' => false,
                ];
                echo json_encode($error);
                return false;
            }
            $error = [
                'message' =>  User::ERRORS['password_user_error'],
                'status' => false,
            ];
            echo json_encode($error);
            return false;
        }
        $error = [
            'message' =>  User::ERRORS['fields_empty'],
            'status' => false,
        ];
        echo json_encode($error);
        return false;
    }

    function actionSignUp()
    {
        $repo = new UserRepository();

        $email =  $this->request->post('email');
        $password = $this->request->post('password');
        $name = $this->request->post('name');

        $email = strip_tags(stripslashes($email));
        $name = strip_tags(stripslashes($name));

        if($name && $email && $password){

            if(!$repo->isValidEmail($email)) {
                $error = [
                    'message' => User::ERRORS['email_error'],
                    'status' => false,
                ];
                echo json_encode($error);
                return false;
            }

            if(!!$repo->isValidPassword($password)){
                $error = [
                    'message' => User::ERRORS['password_error'],
                    'status' => false,
                ];
                echo json_encode($error);
                return false;
            }

            if($repo->existUser($email)){
                $password_hash = $repo->generatePassHash($password);
                $default_hash = $repo->setDefaultHash(11);
                $time_create = time();
                $time_update = time();

                $newUser = new User();
                $newUser->name = $name;
                $newUser->email = $email;
                $newUser->role = User::ROLE_USER;
                $newUser->password_hash = $password_hash;
                $newUser->default_hash = $default_hash;
                $newUser->status = User::STATUS_ACTIVE;
                $newUser->time_create = $time_create;
                $newUser->time_update = $time_update;
                $repo->save($newUser);

                $user = $repo->getUser($email);

                if($user){
                    $this->session->setValue([
                        'email' => $email,
                        'id' => $user->id
                    ]);

                    $result = [
                        'hash' => $default_hash,
                        'status' => true,
                    ];
                    echo json_encode($result);
                    return true;
                }

                $error = [
                    'message' => User::ERRORS['something_wrong'],
                    'status' => false,
                ];
                echo json_encode($error);
                return false;

            }
            $error = [
                'message' => User::ERRORS['user_exist'],
                'status' => false,
            ];
            echo json_encode($error);
            return false;
        }

        $error = [
            'message' => User::ERRORS['fields_empty'],
            'status' => false,
        ];
        echo json_encode($error);
        return false;
    }

    public function actionLogout() {
        $this->session->destroy();
        $this->cookies->setCookies("hash", '');
        $this->request->redirect('/');
        exit();
    }
}