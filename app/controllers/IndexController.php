<?php

class IndexController extends ControllerBase
{
    
    public function indexAction()
    {
        $this->view->setVar('posts', Posts::find());
    }

}

