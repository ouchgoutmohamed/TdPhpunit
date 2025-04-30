<?php

namespace Tests;

use App\Models\BonLivraison;
use CodeIgniter\Test\Fabricator;
use PHPUnit\Framework\TestCase;

class BonLivraisonModelTest extends TestCase
{
    public function testFindBonLivraison()
    {        
        $this->assertIsArray((new BonLivraison())->findAll(), "findAll doit retourner un tableau.");
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
        
        $id = $model->insert($bon_livraison_data);
        
        $this->assertGreaterThan(0, $id, "L'insertion doit retourner un ID supérieur à 0.");

        if ($id) {
            $model->delete($id);
        }
    }
}
