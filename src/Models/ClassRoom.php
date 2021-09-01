<?php

namespace Training\Models;


class ClassRoom extends AbstractRoom
{
    private int $roomCapacity = 25;
    private string $id;

    public function __construct()
    {
        $this->id = uniqid();
    }

    public function getRoomCapacity(): int
    {
        return $this->roomCapacity;
    }

    public function increaseCapacity(int $increase): void
    {
        $this->roomCapacity += $increase;
    }


    public function addHostInRoom(User $user): void
    {
        $this->usersInRoom[$user->id]['user'] = $user;
        $this->usersInRoom[$user->id]['type'] = Enum::HOST;
    }

    public function getId(): string
    {
        return $this->id;
    }
}