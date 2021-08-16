<?php


namespace Training\Services;

use Training\Exceptions\TrainingException;
use Training\Models\Room;
use Training\Models\User;

class RoomService
{
    /**
     * @var User
     */
    private $user;
    /**
     * @var Room
     */
    private $room;

    /**
     * @param User $user
     * @param Room $room
     */
    public function __construct(User $user, Room $room)
    {
        $this->user = $user;
        $this->room = $room;
        $this->room->addInRoom($user);
    }

    /**
     * @throws TrainingException
     */
    public function create(): object
    {
        if ($this->userStudent($this->user)) {
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
        if ($user->getUserType() == User::STUDENT) {
            $user->microphone = 0;
        }
    }

    public function userStudent(User $user): bool
    {
        return ($user->getUserType() == User::STUDENT);
    }

}