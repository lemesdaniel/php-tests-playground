<?php

namespace Tests\Training\Room;

use PHPUnit\Framework\TestCase;
use Training\Models\ClassRoom;
use Training\Models\Enum;
use Training\Models\User;


class RoomTest extends TestCase
{

    /**
     * @test
     */
    public function checkIfMaxUserRoomIs25()
    {
        $room = new ClassRoom();
        $this->assertEquals(25, $room->getRoomCapacity());
    }

    /**
     * @test
     */

    public function countUsersInRoom()
    {
        $room = new ClassRoom();
        for ($i = 0; $i < 10; $i++) {
            $room->addInRoom(new User());
        }

        $this->assertEquals(10, $room->countUserInRoom());
    }

    /**
     * @test
     */
    public function checkIfUserIsStudent()
    {
        $room = new ClassRoom();
        $user = new User();
        $room->addInRoom($user);

        $this->assertEquals(Enum::STUDENT, $room->getUserType($user));
    }

    /**
     * @test
     */
    public function checkIfItIsPossibleIncreaseCapacity()
    {
        $room = new ClassRoom();
        $room->increaseCapacity(5);
        $this->assertEquals(30, $room->getRoomCapacity());
    }

}
