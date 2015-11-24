<?php
namespace App\Models;

class Tokens extends \Phalcon\Mvc\Model
{
    /**
     *
     * @var integer
     */
    public $userId;

    /**
     *
     * @var string
     */
    public $token;
}
