<?php

class Users extends \Phalcon\Mvc\Model
{
    public function validation()
    {
        $this->validate(new Email(
            array(
                "field" => "email",
                "message" => "the email is not valid"
            )
        ));

        $this->validate(new Uniqueness(
            array(
                "field" => "username",
                "message" => "Username must be unique"
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
    public $username;

    public $email;

    /**
     *
     * @var string
     */
    public $password;

    public $fullname;

    public $profile;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Posts', 'users_id', NULL);
    }

}
