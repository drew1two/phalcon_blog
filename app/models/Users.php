<?php

class Users extends \Phalcon\Mvc\Model
{
    public function validation()
    {
        $this->validate(new Email(
            array(
                "field" => "login",
                "message" => "the email is not valid"
            )
        ));

        $this->validate(new Uniqueness(
            array(
                "field" => "login",
                "message" => "The login must be unique"
            )
        ));

        return $this->validationHasFailed() !=true;
    }
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $login;

    /**
     *
     * @var string
     */
    public $password;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Posts', 'users_id', NULL);
    }

}
