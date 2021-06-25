<?php

declare(strict_types=1);

namespace Training\Status\Model;

/**
 * Model Status
 *
 * @package Training\Status\Model
 * @date    23/06/2021 06:40
 *
 * @author  Fernando Petry <fernando.petry@autoavaliar.com.br>
 */
class StatusModel
{
    public $id;
    public $name;
    public $status;
    public $flagDefault;

    const STATUS_DEFAULT = 1;

    public static function findFirst($id)
    {
        if ($id != 1) {
            return false;
        }

        $status = new self();
        $status->id = 1;
        $status->name = 'Fernando';
        $status->status = 1;
        $status->flagDefault = 1;
        return $status;
    }

    public function save($data = null): bool
    {
        if ($data || is_null($data)) {
            return true;
        }

        return false;
    }
}