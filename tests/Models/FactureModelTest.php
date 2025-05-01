<?php
namespace Tests\Models;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\FactureModel;

class FactureModelTest extends CIUnitTestCase
{
    protected $factureModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->factureModel = new FactureModel();
    }

    public function testInsertFacture()
    {
        $data = [
            'dateFact' => '2024-04-25',
            'client'   => 'Entreprise XYZ',
            'total'    => 1500.50
        ];

        $id = $this->factureModel->insert($data);
        $this->assertIsInt($id);
        $this->assertGreaterThan(0, $id);

        // Vérifier que la facture a été insérée
        $facture = $this->factureModel->find($id);
        $this->assertEquals('Entreprise XYZ', $facture['client']);
    }

    public function testFindAllFactures()
    {
        $factures = $this->factureModel->findAll();
        $this->assertIsArray($factures);
    }

    public function testUpdateFacture()
    {
        $data = [
            'dateFact' => '2024-04-25',
            'client'   => 'Client Test',
            'total'    => 1000
        ];

        $id = $this->factureModel->insert($data);

        $updated = $this->factureModel->update($id, ['total' => 1200]);
        $this->assertTrue($updated);

        $facture = $this->factureModel->find($id);
        $this->assertEquals(1200, $facture['total']);
    }

    public function testDeleteFacture()
    {
        $data = [
            'dateFact' => '2024-04-25',
            'client'   => 'Client à supprimer',
            'total'    => 500
        ];

        $id = $this->factureModel->insert($data);
        $this->assertTrue($this->factureModel->delete($id));

        $this->assertNull($this->factureModel->find($id));
    }
}