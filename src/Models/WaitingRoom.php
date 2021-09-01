<?php

namespace Training\Models;

class WaitingRoom extends AbstractRoom
{
    private int $room_id;
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }

    /**
     * @return int
     */
    public function getRoomId(): int
    {
        return $this->room_id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param int $room_id
     * @return WaitingRoom
     */
    public function setRoomId(int $room_id): WaitingRoom
    {
        $this->room_id = $room_id;
        return $this;
    }

}