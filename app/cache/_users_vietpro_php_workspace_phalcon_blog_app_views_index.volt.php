<?php use Phalcon\Tag as Tag ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Blog Tutorial</title>
    <?php echo $this->tag->stylesheetLink('bootstrap/css/bootstrap.css'); ?>
    <?php echo $this->tag->stylesheetLink('bootstrap/css/bootstrap-responsive.css'); ?>
    <?php echo $this->tag->stylesheetLink('css/style.css'); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="" style="color:white">Share Blog</a>
          <div class="nav-collapse">
            <ul class="nav pull-left">
              <li>
                <?php echo Phalcon\Tag::linkTo('index', 'Home Page') ?>
              </li>
              <?php if ($this->session->has('auth')) { ?>
                <li>
                    <?php echo Phalcon\Tag::linkTo('posts/index', 'Posts') ?>
                </li>
                <li>
                    <?php echo Phalcon\Tag::linkTo('categories/index', 'Categories') ?>
                </li>
              <?php } ?>
            </ul>
            <ul class="nav pull-right">
              <?php if ($this->session->has('auth')) { ?>
                <li>
                  <?php echo Phalcon\Tag::linkTo('users/show', 'User') ?>
                </li>
                <li>
                    <?php echo Phalcon\Tag::linkTo('users/logout', 'Log out') ?>
                </li>
              <?php } else { ?>
                <li>
                    <?php echo Phalcon\Tag::linkTo('users/index', 'Log in') ?>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <?php echo $this->getContent(); ?>
    </div>
    <?php echo $this->tag->javascriptInclude('js/jquery.min.js'); ?>
    <?php echo $this->tag->javascriptInclude('bootstrap/js/bootstrap.js'); ?>
    <?php echo $this->tag->javascriptInclude('js/utils.js'); ?>
    <?php echo $this->tag->javascriptInclude('ckeditor/ckeditor.js'); ?>
  </body>
</html>