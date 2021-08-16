<?php

namespace Tests\Services;

use Exception;
use Mockery;
use Training\Exceptions\TrainingException;
use Training\Models\Room;
use Training\Models\User;
use Training\Services\RoomService;
use PHPUnit\Framework\TestCase;

class RoomServiceTest extends TestCase
{


    /**
     * @test
     * @throws TrainingException
     */
    public function createNewClass()
    {
        $user = Mockery::mock(User::class);
        $user->shouldReceive("getUserType")
            ->andReturn(User::HOST);
        $room = new Room();

        $class = new RoomService($user, $room);
        $this->assertObjectHasAttribute('roomCapacity' , $class->create());

    }

    /**
     * @test
     * @throws \Exception
     */
    public function createNewClassAndFail()
    {
        $this->expectException(TrainingException::class);
        $user = Mockery::mock(User::class);
        $user->shouldReceive("getUserType")
            ->andReturn(User::STUDENT);
        $room = new Room();
        $class = new RoomService($user, $room);
        $class->create();
        $this->getExpectedException();
    }


    /**
     * @test
     */
    public function muteAllStudent()
    {
        $this->expectException(TrainingException::class);
        $user = Mockery::mock(User::class);
        $user->shouldReceive("getUserType")
            ->andReturn(User::STUDENT);
        $room = new Room();
        $class = new RoomService($user, $room);
        for($i=0;$i<25;$i++){
            $class->addUser(new User());
        }
        $class->create();
        $this->expectExceptionObject(TrainingException::class);

    }

    /**
     * @test
     * @throws TrainingException
     */
    public function muteStudent()
    {
        $user = Mockery::mock(User::class);
        $user->shouldReceive("getUserType")
            ->andReturn(User::HOST);
        $room = new Room();
        $class = new RoomService($user, $room);
        $student = new User();
        $class->addUser($student);

        $this->assertEquals(1, $student->microphone);

        $class->muteUser($student);

        $this->assertEquals(0, $student->microphone);

    }



}
