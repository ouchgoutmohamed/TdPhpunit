<?php

namespace Tests;

use App\Models\BonLivraison;
use CodeIgniter\Test\Fabricator;
use PHPUnit\Framework\TestCase;

class BonLivraisonModelTest extends TestCase
{

    private $bonLivraisonId;
 
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

    public function testUpdateBonLivraison()
    {
        $model = new BonLivraison();
        $bonLivraison = $model->orderBy('id', 'desc')->first();
        
        $bonLivraison['etat'] = 'livré';
        $model->update($bonLivraison['id'], $bonLivraison);
        
        $updatedBonLivraison = $model->find($bonLivraison['id']);
        
        $this->assertEquals('livré', $updatedBonLivraison['etat'], "L'état du bon de livraison doit être mis à jour.");
    }
}
