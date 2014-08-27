<?php
use Phalcon\Mvc\Model\Validator\Uniqueness;

class Posts extends \Phalcon\Mvc\Model
{
    public function validation()
    {

        $this->validate(new Uniqueness(
            array(
                "field" => "title",
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
    public $title;

    /**
     *
     * @var string
     */
    public $description;

    /**
     *
     * @var string
     */
    public $content;

    /**
     *
     * @var integer
     */
    public $users_id;

    /**
     *
     * @var integer
     */
    public $categories_id;

    public $created_at;

    public $updated_at;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('users_id', 'Users', 'id', NULL);
        $this->belongsTo('categories_id', 'Categories', 'id', NULL);
    }

}
