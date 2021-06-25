<?php

declare(strict_types=1);

namespace Training\Status\Delete;

use Exception;
use Training\Status\Model\StatusModel;

/**
 * Delete Status
 *
 * @package Training\Status
 * @date    23/06/2021 06:56
 *
 * @author  Fernando Petry <fernando.petry@autoavaliar.com.br>
 */
class StatusDelete
{
    private $statusId;

    /**
     * @var StatusModel
     */
    private $statusModel;

    private $validator;

    public function __construct(int $id, StatusModel $statusModel)
    {
        $this->statusId = $id;
        $this->statusModel = $statusModel;
    }

    public function addValidator(ValidatorInterface $validator)
    {
        $this->validator[] = $validator;
    }

    /**
     * @throws Exception
     */
    private function processValidator(StatusModel $statusModel)
    {
        if (is_null($this->validator)) {
            throw new Exception("Nenhuma validação encontrada!");
        }

        /** @var $validator ValidatorInterface */
        foreach ($this->validator as $validator) {
            $validator->setStatusModel($statusModel);
            if (!$validator->isValid()) {
                throw new Exception($validator->getMessage());
            }
        }
    }

    /**
     * @throws Exception
     */
    public function execute(): bool
    {
        $statusModel = $this->statusModel::findFirst($this->statusId);

        if (!$statusModel) {
            throw new Exception("Status não encontrado");
        }

        $this->processValidator($statusModel);

        return $statusModel->save();
    }
}