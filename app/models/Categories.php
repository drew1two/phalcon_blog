<?php
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Categories extends \Phalcon\Mvc\Model
{
    public function validation()
    {

        $this->validate(new Uniqueness(
            array(
                "field" => "name",
                "message" => "The category is already created"
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
    public $name;

    /**
     *
     * @var string
     */
    public $description;

    public $created_at;

    public $updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('id', 'Posts', 'categories_id', NULL);
    }

}
