<?php

use \Phalcon\Tag as Tag,
    \Phalcon\Mvc\Model\Criteria;

class UsersController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function showAction()
    {

    }

    public  function  newAction()
    {

    }

    public function registerAction()
    {

        if (!$this->request->isPost()) {
            return $this->response->redirect('index');
        }

        $user = new Users();

        $user->assign([
                'first_name' => $this->request->getPost('first_name', 'striptags'),
                'last_name' => $this->request->getPost('last_name', 'striptags'),
                'email' => $this->request->getPost('email'),
                'password' => sha1($this->request->getPost('password')),
                'gender' => $this->request->getPost('gender'),
                'profile' => $this->request->getPost('profile'),
            ]
        );
        if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "users",
                "action" => "new"
            ));
        } else {
            $this->flash->success("User was created successfully");
            return $this->response->redirect('users/index');
        }
    }


    public function loginAction()
    {

        if ($this->request->isPost()) {

            $user = Users::findFirst(array(
                'email = :email: and password = :password:',
                'bind' => array(
                    'email' => $this->request->getPost("email"),
                    'password' => sha1($this->request->getPost("password"))
                )
            ));

            if ( $user=== false){
                $this->flash->error("Incorrect credentials");
                return $this->response->redirect("users/index");
            }

            $this->session->set('auth', $user->id);

            $this->flash->success("You've been successfully logged in");
        }

        return $this->response->redirect("index");
    }

    public function logoutAction()
    {
        $this->session->remove('auth');
        return $this->response->redirect("index");
    }

}