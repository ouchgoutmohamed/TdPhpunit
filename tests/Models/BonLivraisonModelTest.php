<?php

namespace Tests\Models;

use App\Models\BonLivraison;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\Fabricator;

class BonLivraisonModelTest extends CIUnitTestCase
{

    use DatabaseTestTrait;

    private $bonLivraisonId;

    protected $namespace   = 'App';   
    protected $model;
    protected $refresh = true;
    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new BonLivraison();
    }
 
    public function testInsertUser()
    {
        $fabricator = new Fabricator(BonLivraison::class);
        $bon_livraison_data = $fabricator->make();

        $model = new BonLivraison();
        $bon_livraison_data = [
            'dateLivraison' => $bon_livraison_data['dateLivraison'],
            'adresseLivraison' => $bon_livraison_data['adresseLivraison'],
            'etat' => $bon_livraison_data['etat']
        ];
        
        $this->bonLivraisonId = $model->insert($bon_livraison_data);
        
        $this->assertGreaterThan(0, $this->bonLivraisonId, "L'insertion doit retourner un ID supérieur à 0.");
    }

    public function testFindBonLivraisonById()
    {
        $model = new BonLivraison();
        $bonLivraison = $model->find($this->bonLivraisonId);
        
        $this->assertIsArray($bonLivraison, "find doit retourner un tableau.");
        // $this->assertEquals($this->bonLivraisonId, $bonLivraison['id'], "L'ID du bon de livraison doit correspondre à celui inséré.");
    }

    public function testFindAllBonLivraison()
    {
        $model = new BonLivraison();
        $bonLivraisons = $model->findAll();
        
        $this->assertIsArray($bonLivraisons, "findAll doit retourner un tableau.");
    }
}
