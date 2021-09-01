<?php

namespace Tests\Training\Room;

use PHPUnit\Framework\TestCase;
use Training\Models\ClassRoom;


class RoomTest extends TestCase
{

    /**
     * @test
     */
    public function checkIfMaxUserRoomIs25()
    {
        $room = new ClassRoom();
        $room->save();
        $this->assertEquals(25, $room->getRoomCapacity());
    }

    /**
     * @test
     */
    public function checkIfItIsPossibleIncreaseCapacity()
    {
        $room = new ClassRoom();
        $room->save();
        $room->increaseCapacity(5);
        $this->assertEquals(30, $room->getRoomCapacity());
    }

}
