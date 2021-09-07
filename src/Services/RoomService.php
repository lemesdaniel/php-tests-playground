<?php

namespace Training\Services;

use Training\Exceptions\TrainingException;
use Training\Models\Enum;
use Training\Models\ClassRoom;
use Training\Models\User;
use Training\Models\WaitingRoom;

class RoomService
{

    private User $user;
    private ClassRoom $classRoom;
    private WaitingRoom $waitingRoom;

    public function __construct(
        User $user,
        ClassRoom $classRoom,
        WaitingRoom $waitingRoom
    ) {
        $this->user = $user;
        $this->classRoom = $classRoom;
        $this->waitingRoom = $waitingRoom;
        $this->classRoom->addHostInRoom($user);
    }

    public function muteAllUsers(): bool
    {
        foreach ($this->classRoom->allUsers() as $user) {
            $this->muteUser($user);
        }

        return true;
    }


    public function addUserInRoom(User $student): void
    {
        if ($this->classRoom->getRoomCapacity() < $this->classRoom->countUserInRoom())
        {
            //throw new TrainingException("Excede capacidade máxima da sala, aumente seu plano");
            $this->addUserWaitingRoom($student);
        }
        $this->classRoom->addInRoom($student);
    }

    public function addUserWaitingRoom(User $student): void
    {
        $this->waitingRoom->addInRoom($student);
    }


    public function muteUser(User $user): bool
    {
        if ($this->classRoom->getUserType($user) == Enum::STUDENT) {
            $user->mute();
            return true;
        }
        return false;
    }

    public function unMuteUser(User $user): bool
    {
        if (!$user->microphoneIsEnable()) {
            $user->unMute();
            return true;
        }

        return false;
    }

    public function isStudent(User $user): bool
    {
        return ($this->classRoom->getUserType($user) == Enum::STUDENT);
    }


    public function countUsersInWaitingRoom(): int
    {
        return $this->waitingRoom->countUserInRoom();
    }

    public function countUsersInClassRoom(): int
    {
        return $this->classRoom->countUserInRoom();
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    public function countUserInRoom(): int
    {
        return $this->classRoom->countUserInRoom();
    }

    public function countUserInWaitingRoom(): int
    {
        return $this->waitingRoom->countUserInRoom();
    }

}