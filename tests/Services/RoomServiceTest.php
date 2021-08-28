<?php

namespace Tests\Services;

use Training\Exceptions\TrainingException;
use Training\Models\Room;
use Training\Models\User;
use Training\Models\WaitingRoom;
use Training\Services\RoomService;
use PHPUnit\Framework\TestCase;

class RoomServiceTest extends TestCase
{

    public User $user;
    public Room $room;
    public WaitingRoom $waitingRoom;

    public function setUp()
    {
        $this->user = new User();
        $this->room = new Room();
        $this->waitingRoom = new WaitingRoom();
    }

    /**
     * @test
     * @throws \Training\Exceptions\TrainingException
     */
    public function addUser()
    {
        $roomService = new RoomService($this->user, $this->room, $this->waitingRoom);

        $this->assertEquals(1, $roomService->room->countUserInRoom());
        $student = new User();
        $roomService->addUser($student);
        $this->assertEquals(2, $roomService->room->countUserInRoom());
    }

    /**
     * @test
     * @throws \Training\Exceptions\TrainingException
     */
    public function isStudent()
    {
        $roomService = new RoomService($this->user, $this->room, $this->waitingRoom);

        $this->assertFalse($roomService->isStudent($this->user));
        $student = new User();
        $roomService->addUser($student);
        $this->assertTrue($roomService->isStudent($student));
    }

    /**
     * @test
     * @throws \Training\Exceptions\TrainingException
     */
    public function muteUser()
    {
        $roomService = new RoomService($this->user, $this->room, $this->waitingRoom);
        $student = new User();
        $roomService->addUser($student);
        $roomService->muteUser($student);
        $this->assertFalse($student->microphoneIsEnable());
        $roomService->unMuteUser($student);
        $this->assertTrue($student->microphoneIsEnable());
    }

    /**
     * @test
     * @throws \Training\Exceptions\TrainingException
     */
    public function checkCapacityRoom()
    {
        $roomService = new RoomService($this->user, $this->room, $this->waitingRoom);

        for ($i = 0; $i <= 26; $i++) {
            $roomService->addUser(new User());
        }

        $this->assertEquals(25, $roomService->room->countUserInRoom());
        $this->assertEquals(2, $roomService->countUsersWaiting());
    }
}
