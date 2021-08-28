<?php

namespace Training\Models;

class waitingRoom
{
    public int $room_id;
    public User $user;
    public string $id;

    public function __construct(User $user, int $room_id)
    {
        $this->id = uniqid();
        $this->user = $user;
        $this->room_id = $room_id;
    }
}