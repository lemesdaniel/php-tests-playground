<?php

namespace Training\Services;

use Training\Exceptions\TrainingException;
use Training\Models\Enum;
use Training\Models\Room;
use Training\Models\User;

class RoomService
{
    /**
     * @var User
     */
    public $user;
    /**
     * @var Room
     */
    public $room;

    /**
     * @throws TrainingException
     */
    public function __construct(User $user, Room $room)
    {
        $this->user = $user;
        $this->room = $room;
        $this->room->addHostInRoom($user);
        return $this->create();
    }

    /**
     * @throws TrainingException
     */
    public function create(): object
    {
        if ($this->isStudent($this->user)) {
            throw new TrainingException(
                "Operação não permitida para o usuário"
            );
        }

        return $this->room->save();
    }

    /**
     * @throws TrainingException
     */
    public function muteAllUsers(): bool
    {
        foreach ($this->room->allUsers() as $user) {
            $this->muteUser($user);
        }

        return true;
    }

    /**
     * @throws TrainingException
     */
    public function addUser(User $user): void
    {
        if($this->room->countUserInRoom() > $this->room->getRoomCapacity()){
            throw new TrainingException('Excede a capacidade máxima da sala');
        }

        $this->room->addInRoom($user);
    }

    public function muteUser(User $user): void
    {
        if ($this->room->getUserType($user) == Enum::STUDENT) {
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
        return ($this->room->getUserType($user) == Enum::STUDENT);
    }

}