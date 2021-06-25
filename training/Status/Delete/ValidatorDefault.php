<?php

declare(strict_types=1);

namespace Training\Status\Delete;

use Training\Status\Model\StatusModel;

/**
 * Verifica se o status é um padrão que não pode ser excluído
 *
 * @package Training\Status\Delete
 * @date    23/06/2021 07:03
 *
 * @author  Fernando Petry <fernando.petry@autoavaliar.com.br>
 */
class ValidatorDefault implements ValidatorInterface
{
    /** @var StatusModel */
    private $model;

    public function setStatusModel(StatusModel $model)
    {
        $this->model = $model;
    }

    public function isValid(): bool
    {
        if ($this->model->flagDefault == StatusModel::STATUS_DEFAULT) {
            return false;
        }

        return true;
    }

    public function getMessage(): string
    {
        return 'Este status não pode ser removido, porque é um status padrão do sistema';
    }


}