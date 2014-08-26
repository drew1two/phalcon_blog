<?php

use \Phalcon\Tag as Tag,
    \Phalcon\Mvc\Model\Criteria;

class CategoriesController extends ControllerBase
{

    public function indexAction()
    {
        $this->session->conditions = null;
        $this->view->setVar('categories', Categories::find());
    }

    public function newAction()
    {

    }

    public function editAction($id)
    {

        $request = $this->request;
        if (!$request->isPost()) {

            $categories = Categories::findFirst($id);
            if (!$categories) {
                $this->flash->error("The category was not found");
                return $this->response->redirect("categories/index");
            }
            $this->view->setVar("id", $categories->id);

            Tag::displayTo("id", $categories->id);
            Tag::displayTo("name", $categories->name);
            Tag::displayTo("description", $categories->description);
        }
    }

    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->response->redirect('index');
        }

        $categories = new Categories();
        $categories->id = $this->request->getPost("id");
        $categories->name = $this->request->getPost("name");
        $categories->description = $this->request->getPost("description");
        if (!$categories->save()) {
            foreach ($categories->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "new"
            ));
        } else {
            $this->flash->success("The category was created successfully");
            return $this->response->redirect("categories/index");
        }

    }

    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->response->redirect("categories/index");
        }

        $id = $this->request->getPost("id");

        $category = Categories::findFirstByid($id);
        if (!$category) {
            $this->flash->error("The category does not exist" . $id);
            return $this->response->redirect("categories/index");
        }

        $category->id = $this->request->getPost("id");
        $category->name = $this->request->getPost("name");
        $category->description = $this->request->getPost("description");

        if (!$category->save()) {
            foreach ($category->getMessages() as $message) {
                $this->flash->error((string) $message);
            }
            return $this->dispatcher->forward(array(
                "controller" => "categories",
                "action" => "edit",
                "params" => array($category->id)
            ));
        } else {
            $this->flash->success("categories was updated successfully");
            return $this->response->redirect("categories/index");
        }

    }

    public function deleteAction($id)
    {
        $categories = Categories::findFirst($id);
        if (!$categories) {
            $this->flash->error("The category was not found");
            return $this->response->redirect("categories/index");
        }

        if (!$categories->delete()) {
            foreach ($categories->getMessages() as $message){
                $this->flash->error((string) $message);
            }
            return $this->response->redirect("categories/index");
        } else {
            $this->flash->success("The category was deleted");
            return $this->response->redirect("categories/index");
        }
    }

}