<?php

namespace Training\Models;

class AbstractRoom
{
    protected array $usersInRoom = [];

    public function allUsers(): array
    {
        return $this->usersInRoom;
    }

    public function addInRoom(User $user): void
    {
        $this->usersInRoom[$user->id]['user'] = $user;
        $this->usersInRoom[$user->id]['type'] = Enum::STUDENT;
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