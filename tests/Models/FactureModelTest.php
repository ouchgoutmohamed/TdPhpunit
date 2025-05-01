<?php

namespace Tests\Models;

use App\Models\Facture;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\Fabricator;

class FactureModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    private $factureId;

    protected $namespace = 'App';
    protected $model;
    protected $refresh = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new Facture();
    }

    public function testInsertFacture()
    {
        $fabricator = new Fabricator(Facture::class);
        $facture_data = $fabricator->make();

        $model = new Facture();
        $facture_data = [
            'dateFact' => $facture_data['dateFact'],
            'client' => $facture_data['client'],
            'total' => $facture_data['total']
        ];

        $this->factureId = $model->insert($facture_data);

        $this->assertGreaterThan(0, $this->factureId, "L'insertion doit retourner un ID supérieur à 0.");
    }

    public function testFindFactureById()
    {
        $fabricator = new Fabricator(Facture::class);
        $facture_data = $fabricator->make();

        $factureId = $this->model->insert($facture_data);
        $facture = $this->model->find($factureId);

        $this->assertIsArray($facture, "find doit retourner un tableau.");
        $this->assertEquals($factureId, $facture['id'], "L'ID de la facture doit correspondre à celui inséré.");
    }


    public function testInsertFactureWithMaxTotal()
    {
        $facture_data = [
            'dateFact' => '2025-05-01',
            'client' => 'Test Client',
            'total' => 99999999.99
        ];

        $factureId = $this->model->insert($facture_data);
        $this->assertGreaterThan(0, $factureId, "L'insertion doit réussir avec un total maximum.");

        $facture = $this->model->find($factureId);
        $this->assertEquals(99999999.99, $facture['total'], "Le total maximum doit être correctement enregistré.");
    }

    public function testInsertFactureWithZeroTotal()
    {
        $facture_data = [
            'dateFact' => '2025-05-01',
            'client' => 'Test Client',
            'total' => 0.00
        ];

        $factureId = $this->model->insert($facture_data);
        $this->assertGreaterThan(0, $factureId, "L'insertion doit réussir avec un total de 0.");

        $facture = $this->model->find($factureId);
        $this->assertEquals(0.00, $facture['total'], "Le total doit être 0.00.");
    }
}