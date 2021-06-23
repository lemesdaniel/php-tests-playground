<?php

declare(strict_types=1);

namespace Training;

/**
 * Hello World
 *
 * @package Training
 * @date    23/06/2021 06:29
 *
 * @author  Fernando Petry <fernando.petry@autoavaliar.com.br>
 */
class Hello
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getMessage(): string
    {
        return "Hello, " . $this->name . "!";
    }
}