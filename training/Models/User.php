<?php


namespace Training\Models;


class User
{
    public $id, $name;
    public const HOST = 3;
    public const COHOST = 2;
    public const STUDENT = 1;
    protected $type;
    /**
     * @var int
     */
    public $microphone = 1;

    public function __construct()
    {
        $this->id = uniqid();
        $this->type = self::STUDENT;
    }

    public function getUserType()
    {
        return $this->type;
    }
}