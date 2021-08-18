<?php


namespace Training\Models;


class User
{
    public $name;
    public $id;
    /**
     * @var int
     */
    private $microphone = 1;

    public function __construct()
    {
        $this->id = uniqid();
    }

    public function mute(): void
    {
        $this->microphone = 0;
    }

    public function unmute(): void
    {
        $this->microphone = 1;
    }

    public function microphoneIsEnable(): bool
    {
        return (bool) $this->microphone;
    }

}