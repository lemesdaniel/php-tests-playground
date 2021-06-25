<?php

declare(strict_types=1);

namespace Training\Status\Delete;

use Training\Status\Model\StatusModel;

/**
 * Interface de validação
 *
 * @package Training\Status\Delete
 * @date    23/06/2021 07:01
 *
 * @author  Fernando Petry <fernando.petry@autoavaliar.com.br>
 */
interface ValidatorInterface
{
    public function setStatusModel(StatusModel $model);

    public function isValid(): bool;

    public function getMessage(): string;
}