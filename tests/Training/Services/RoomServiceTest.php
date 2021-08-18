<?php

namespace Tests\Services;

use Training\Exceptions\TrainingException;
use Training\Models\Room;
use Training\Models\User;
use Training\Services\RoomService;
use PHPUnit\Framework\TestCase;

class RoomServiceTest extends TestCase
{

    public $user;
    public $room;

    public function setUp()
    {
        $this->user = new User();
        $this->room = new Room();
    }

    /**
     * @test
     * @throws \Training\Exceptions\TrainingException
     */
    public function addUser()
    {
        $roomService = new RoomService($this->user, $this->room);

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
        $roomService = new RoomService($this->user, $this->room);

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
        $roomService = new RoomService($this->user, $this->room);
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
        $this->expectException(TrainingException::class);
        $roomService = new RoomService($this->user, $this->room);
        for ($i = 0; $i <= 26; $i++) {
            $roomService->addUser(new User());
        }

    }
}
