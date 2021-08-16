<?php


namespace Training\Models;


class Room
{
    /**
     * @var int
     */
    private $roomCapacity = 25;
    /**
     * @var array
     */
    private $usersInRoom = [];


    /**
     * @return int
     */
    public function getRoomCapacity(): int
    {
        return $this->roomCapacity;
    }

    /**
     * @param int $increase
     */
    public function increaseCapacity(int $increase): void
    {
        $this->roomCapacity += $increase;
    }

    /**
     * @return object
     */
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
        $this->usersInRoom[$user->id] = $user;
    }

    public function countUserInRoom(){
        return count($this->usersInRoom);
    }
}