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
        $model = new Facture();
        $facture = $model->find($this->factureId);

        $this->assertIsArray($facture, "find doit retourner un tableau.");
        // $this->assertEquals($this->factureId, $facture['id'], "L'ID de la facture doit correspondre à celui inséré.");
    }

    public function testFindAllFactures()
    {
        $model = new Facture();
        $factures = $model->findAll();

        $this->assertIsArray($factures, "findAll doit retourner un tableau.");
    }
}