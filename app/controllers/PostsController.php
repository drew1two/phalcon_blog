<?php
use \Phalcon\Tag as Tag,
    \Phalcon\Mvc\Model\Criteria;

class PostsController extends ControllerBase
{

    /**
     * So if we want to check if the User has access to Post::createAction(),
     * all we need to do is to check if matching session variable exists and contains
     * expected value. (Keep in mind that this “authorization system” is very simple)
     */
    public function beforeExecuteRoute($dispatcher)
    {

        //actions which we want to keep from outside access
        $restricted = array('create', 'delete', '', 'new');

        //auth token
        $auth = $this->session->get('auth');

        //we check here if currently invoked action is restricted and if
        //the user is logged in
        if (in_array($dispatcher->getActionName(), $restricted) && !$auth) {

            $this->flash->error("You don't have access to this module");

            $this->dispatcher->forward(array(
                'controller' => 'index',
                'action' => 'index'
            ));

            //Returning false means that execute the action must be aborted
            return false;
        }
    }

    /**
     * We simply pass all the posts created to the view
     */
    public function indexAction()
    {
        $this->view->setVar('posts', Posts::find());
    }

    /**
     * Let’s read that record from the database. When using MySQL adapter,
     * like we do in this tutorial, $slug variable will be escaped so
     * we don’t have to deal with it.
     */
    public function showAction($id)
    {
        $post = Posts::findFirst($id);

        if ($post === false) {
            $this->flash->error("Sorry, post not found");
            return $this->response->redirect('posts/index');
        }

        $this->view->setVar('post', $post);
    }

    public function newAction()
    {
        $this->view->setVar("categories", Categories::find());
    }

    public function createAction()
    {
      $request = $this->request;

      if(!$request->isPost()) {
         return $this->response->redirect("posts/index");
      }

      $posts = new Posts();
      $posts->id = $request->getPost("id", "int");
      $posts->categories_id = $request->getPost("categories_id", "int");
      $posts->title = $request->getPost("title");
      $posts->slug = $request->getPost("slug");
      $posts->content = $request->getPost("content");
      $posts->created = $request->getPost("created");
      $posts->users_id = $this->session->get('auth', $user->id);

      if(!$posts->save()) {

        foreach ($posts->getMessages() as $message) {
          $this->flash->error((string) $message);
        }
        return $this->forward("posts/new");
      } else {
        $this->flash->success("Post was created successflly");
        return $this->response->redirect("posts/index");
      }
    }

    public function editAction($id)
    {
        $request = $this->request;
        if (!$request->isPost()) {

            $id = $this->filter->sanitize($id, array("int"));

            $posts = Posts::findFirst('id="' . $id . '"');
            if (!$posts) {
                $this->flash->error("The post was not found");
                return $this->response->redirect("posts/index");
            }
            $this->view->setVar("id", $posts->id);

            Tag::displayTo("id", $posts->id);
            Tag::displayTo("categories_id", $posts->categories_id);
            Tag::displayTo("title", $posts->title);
            Tag::displayTo("slug", $posts->slug);
            Tag::displayTo("content", $posts->content);

            $this->view->setVar("categories", Categories::find());
        }
    }

    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->response->redirect("posts/index");
        }

        $id = $this->request->getPost("id");

        $post = Posts::findFirstByid($id);
        if (!$post) {
            $this->flash->error("The post does not exist" . $id);
            return $this->response->redirect("posts/index");
        }

        $request = $this->request;
        $post->id = $request->getPost("id", "int");
        $post->categories_id = $request->getPost("categories_id", "int");
        $post->title = $request->getPost("title");
        $post->slug = $request->getPost("slug");
        $post->content = $request->getPost("content");
        $post->created = $request->getPost("created");
        $post->users_id = $this->session->get('auth', $user->id);

        if (!$post->save()) {
            foreach ($post->getMessages() as $message) {
                $this->flash->error((string) $message);
            }

            return $this->response->redirect("posts/edit".$post->id);
        } else {
            $this->flash->success("Post was updated successfully");
            return $this->response->redirect("posts/index");
        }

    }


    public function deleteAction($id)
    {
        $posts = Posts::findFirst($id);
        if (!$posts) {
            $this->flash->error("The category was not found");
            return $this->response->redirect("posts/index");
        }

        if (!$posts->delete()) {
            foreach ($posts->getMessages() as $message){
                $this->flash->error((string) $message);
            }
            return $this->response->redirect("posts/index");
        } else {
            $this->flash->success("The category was deleted");
            return $this->response->redirect("posts/index");
        }
    }

}