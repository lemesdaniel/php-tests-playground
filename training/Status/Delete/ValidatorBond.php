<?php

declare(strict_types=1);

namespace Training\Status\Delete;

use Training\Status\Model\StatusBond;
use Training\Status\Model\StatusModel;

/**
 * Verifica se o status tem alguma relação com outro ponto do sistema
 *
 * @package Training\Status\Delete
 * @date    23/06/2021 07:06
 *
 * @author  Fernando Petry <fernando.petry@autoavaliar.com.br>
 */
class ValidatorBond implements ValidatorInterface
{
    /** @var StatusBond */
    private $modelBond;

    /** @var StatusModel */
    private $model;

    public function __construct(StatusBond $modelBond)
    {
        $this->modelBond = $modelBond;
    }

    public function setStatusModel(StatusModel $model)
    {
        $this->model = $model;
    }

    public function isValid(): bool
    {
        if ($this->modelBond::find('statusId = ' . $this->model->id)) {
            return false;
        }

        return true;
    }

    public function getMessage(): string
    {
        return 'Status não pode ser excluído porque está registrado em um ou mais esquemas';
    }

}