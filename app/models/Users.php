<?php
use Phalcon\Mvc\Model\Validator\Email as Email;
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Users extends \Phalcon\Mvc\Model
{
    public function validation()
    {
        $this->validate(new Email(
            array(
                "field" => "email",
                "require" => true
            )
        ));

        $this->validate(new Uniqueness(
            array(
                "field" => "email",
                "message" => "The email is already registered"
            )
        ));

        if ($this->validationHasFailed() == true) {
            return false;
        }
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
    public $first_name;

    public $last_name;

    public $email;

    /**
     *
     * @var string
     */
    public $password;

    public $gender;

    public $profile;

    public $created_at;

    public $updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Posts', 'users_id', NULL);
    }

}
