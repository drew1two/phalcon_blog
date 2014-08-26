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
                'username' => $this->request->getPost('username', 'striptags'),
                'fullname' => $this->request->getPost('username', 'striptags'),
                'email' => $this->request->getPost('email'),
                'password' => $this->security->hash($this->request->getPost('password')),
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
            return $this->response->redirect('index');
        }
    }


    public function loginAction()
    {

        if ($this->request->isPost()) {

            $user = Users::findFirst(array(
                'username = :username: and password = :password:',
                'bind' => array(
                    'username' => $this->request->getPost("username"),
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