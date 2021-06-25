<?php

namespace Tests\Training\Status\Delete;

use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;
use Training\Status\Delete\StatusDelete;
use Training\Status\Delete\ValidatorBond;
use Training\Status\Delete\ValidatorDefault;
use Training\Status\Model\StatusBond;
use Training\Status\Model\StatusModel;

// https://github.com/mockery/mockery
class StatusDeleteTest extends TestCase
{
    private $statusModelDefault;
    private $statusModelNotDefault;

    private $modelBond;

    protected function setUp()
    {
        $this->statusModelDefault = new StatusModel();
        $this->statusModelDefault->id = '1';
        $this->statusModelDefault->name = 'Fernando';
        $this->statusModelDefault->status = '1';
        $this->statusModelDefault->flagDefault = '1';

        $this->statusModelNotDefault = new StatusModel();
        $this->statusModelNotDefault->id = '1';
        $this->statusModelNotDefault->name = 'Fernando';
        $this->statusModelNotDefault->status = '0';
        $this->statusModelNotDefault->flagDefault = '0';

        $this->modelBond = new StatusBond();
        $this->modelBond->id = 1;
        $this->modelBond->statusId = 1;
    }

    private function mockStatusModel($return)
    {
        $statusModel = Mockery::mock(StatusModel::class);
        $statusModel->shouldReceive('findFirst')->andReturns($return);
        return $statusModel;
    }

    private function mockStatusBond($return)
    {
        $modelBond = Mockery::mock(StatusBond::class);
        $modelBond->shouldReceive('find')->andReturns($return);
        return $modelBond;
    }

    /**
     * @throws Exception
     */
    public function testFluxoFeliz_StatusNaoDefault_SemBond()
    {
        $status = new StatusDelete(1, $this->mockStatusModel($this->statusModelNotDefault));
        $status->addValidator(new ValidatorDefault());
        $status->addValidator(new ValidatorBond($this->mockStatusBond(false)));

        parent::assertEquals(true, $status->execute());
    }

    public function testComBondExistente_StatusNaoDefault()
    {
        parent::expectException(Exception::class);

        $status = new StatusDelete(1, $this->mockStatusModel($this->statusModelNotDefault));
        $status->addValidator(new ValidatorDefault());
        $status->addValidator(new ValidatorBond($this->mockStatusBond([$this->modelBond])));

        parent::assertEquals(true, $status->execute());
    }

    public function testValidadorNaoInformado()
    {
        parent::expectException(Exception::class);
        $status = new StatusDelete(1, $this->statusModelDefault);
        $status->execute();
    }

    public function testStatusInexistente()
    {
        parent::expectException(Exception::class);
        $status = new StatusDelete(5, $this->mockStatusModel(false));
        $status->addValidator(new ValidatorDefault());
        $status->addValidator(new ValidatorBond(new StatusBond()));
        $status->execute();

        parent::assertTrue(true);
    }

    protected function tearDown()
    {
        Mockery::close();
    }

}
