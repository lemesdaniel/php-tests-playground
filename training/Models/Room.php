<?php

namespace Training\Models;


class Room
{
    public $roomCapacity = 25;
    public $usersInRoom = [];

    public function getRoomCapacity(): int
    {
        return $this->roomCapacity;
    }

    public function increaseCapacity(int $increase): void
    {
        $this->roomCapacity += $increase;
    }

    public function save(): object
    {
        return (object)[
            'id' => uniqid(),
            'roomCapacity' => $this->roomCapacity,
            'capacity' => 0
        ];
    }

    public function allUsers(): array
    {
        return $this->usersInRoom;
    }

    public function addInRoom(User $user): void
    {
        $this->usersInRoom[$user->id]['user'] = $user;
        $this->usersInRoom[$user->id]['type'] = Enum::STUDENT;
    }

    public function addHostInRoom(User $user): void
    {
        $this->usersInRoom[$user->id]['user'] = $user;
        $this->usersInRoom[$user->id]['type'] = Enum::HOST;
    }

    public function countUserInRoom(): int
    {
        return count($this->usersInRoom);
    }

    public function getUserType(User $user): int
    {
        return $this->usersInRoom[$user->id]['type'];
    }
}