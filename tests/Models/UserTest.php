<?php

namespace Tests\Models;

use Training\Models\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function testUnmute()
    {
        $user = new User();
        $this->assertTrue($user->microphoneIsEnable());
    }

    public function testMute()
    {
        $user = new User();
        $user->mute();
        $this->assertFalse($user->microphoneIsEnable());
    }

}
