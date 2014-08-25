<?php

class IndexController extends ControllerBase
{
    
    public function indexAction()
    {
        $this->view->setVar('categories', Categories::find());
        $this->view->setVar('posts', Posts::find());
    }

}

