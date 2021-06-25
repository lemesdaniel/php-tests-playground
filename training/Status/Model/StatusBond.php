<?php

declare(strict_types=1);

namespace Training\Status\Model;

/**
 * Model Status Bond
 *
 * @package Training\Status\Model
 * @date    23/06/2021 06:47
 *
 * @author  Fernando Petry <fernando.petry@autoavaliar.com.br>
 */
class StatusBond
{
    public $id;
    public $statusId;

    private static function mockList(): array
    {
        $response = [];

        $bound1 = new self();
        $bound1->id = 1;
        $bound1->statusId = 1;
        $response[] = $bound1;

        $bound2 = new self();
        $bound2->id = 2;
        $bound2->statusId = 2;
        $response[] = $bound2;

        return $response;
    }

    public static function find($query = null)
    {
        if (is_null($query)) {
            return self::mockList();
        }

        if ($query == 'statusId = 1') {
            return self::mockList()[0];
        }

        return false;
    }

    public function save($data = null): bool
    {
        if ($data || is_null($data)) {
            return true;
        }

        return false;
    }
}