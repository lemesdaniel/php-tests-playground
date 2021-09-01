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

    /**
     * @throws TrainingException
     */
    public function addUser(User $user, User $student): void
    {
        if (!$this->isStudent($user)
            && ($this->classRoom->countUserInRoom() > $this->classRoom->getRoomCapacity())
        ) {
            throw new TrainingException('Excede a capacidade máxima da sala');
        }

        $this->classRoom->addInRoom($student);
    }

    public function muteUser(User $user): void
    {
        if ($this->classRoom->getUserType($user) == Enum::STUDENT) {
            $user->mute();
        }
    }

    public function unMuteUser(User $user): void
    {
        if (!$user->microphoneIsEnable()) {
            $user->unMute();
        }
    }

    public function isStudent(User $user): bool
    {
        return ($this->classRoom->getUserType($user) == Enum::STUDENT);
    }

    /**
     * @return WaitingRoom
     */
    public function getWaitingRoom(): WaitingRoom
    {
        return $this->waitingRoom;
    }

    /**
     * @return ClassRoom
     */
    public function getClassRoom(): ClassRoom
    {
        return $this->classRoom;
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

}