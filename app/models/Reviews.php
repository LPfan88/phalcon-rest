<?php
namespace App\Models;

class Reviews extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $userId;

    /**
     *
     * @var string
     */
    public $text;

    /**
     *
     * @var string
     */
    public $datetime;

    /**
     *
     * @var double
     */
    public $rating;
}
