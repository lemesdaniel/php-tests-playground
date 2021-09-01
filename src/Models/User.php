<?php


namespace Training\Models;


class User
{
    public string $name;
    public string $id;
    private int $microphone;

    public function __construct()
    {
        $this->id = uniqid();
        $this->microphone = 1;
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