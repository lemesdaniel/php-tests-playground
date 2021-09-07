<?php

namespace Tests\Services;

use Mockery;
use Training\Models\ClassRoom;
use Training\Models\User;
use Training\Models\WaitingRoom;
use Training\Services\RoomService;
use PHPUnit\Framework\TestCase;

class RoomServiceTest extends TestCase
{

    public User $user;
    public ClassRoom $room;
    public WaitingRoom $waitingRoom;

    public function setUp(): void
    {
        $this->user = new User();
        $this->room = new ClassRoom();
        $this->waitingRoom = new WaitingRoom();
    }

    /**
     * @test
     * @throws \Training\Exceptions\TrainingException
     */
    public function addUser()
    {
        $roomService = new RoomService($this->user, $this->room, $this->waitingRoom);

        $this->assertEquals(1, $roomService->countUserInRoom());
        $student = new User();
        $roomService->addUserInRoom($student);
        $this->assertEquals(2, $roomService->countUserInRoom());
    }

    /**
     * @test
     */
    public function isStudent()
    {
        $roomService = new RoomService($this->user, $this->room, $this->waitingRoom);

        $this->assertFalse($roomService->isStudent($this->user));
        $student = new User();
        $roomService->addUserInRoom($student);
        $this->assertTrue($roomService->isStudent($student));
    }

    /**
     * @test
     */
    public function muteUser()
    {
        $roomService = new RoomService($this->user, $this->room, $this->waitingRoom);
        $student = new User();
        $roomService->addUserInRoom($student);
        $roomService->muteUser($student);
        $this->assertFalse($student->microphoneIsEnable());
        $roomService->unMuteUser($student);
        $this->assertTrue($student->microphoneIsEnable());
    }

    /**
     * @test
     */
    public function AddUsersWhoExceedCapacityToTheWaitingRoom()
    {
        $roomService = new RoomService($this->user, $this->room, $this->waitingRoom);
        for ($i=0; $i < 30; $i++)
        {
            $roomService->addUserInRoom(new User());
        }
        $this->assertEquals(5, $roomService->countUsersInWaitingRoom());

    }
}
