<?php

namespace Tests\Models;

use App\Models\LigneLivraisonModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
// You might need to create dummy BonLivraison and Article records for foreign key constraints
// use App\Models\BonLivraison;
// use App\Models\ArticleModel; // Assuming you have an ArticleModel

class LigneLivraisonModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    // We need to declare `$namespace` to allow migrations to run
    protected $namespace = 'App';
    protected $model;
    protected $refresh = true; // Reset the database for each test

    // Dummy IDs for foreign keys - adjust if needed or create real records
    protected $dummyBonLivraisonId = 1;
    protected $dummyArticleId = 1;

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new LigneLivraisonModel();

        // Optional: Create dummy parent records if foreign keys are enforced strictly
        // $bonLivraisonModel = new BonLivraison();
        // $this->dummyBonLivraisonId = $bonLivraisonModel->insert(['dateLivraison' => '2025-05-01', 'adresseLivraison' => '123 Test St', 'etat' => 'pending']);
        // $articleModel = new ArticleModel(); // Assuming ArticleModel exists
        // $this->dummyArticleId = $articleModel->insert(['reference' => 'ART001', 'libelle' => 'Test Article', 'quantite_commande' => 10]); // Adjust fields as needed
    }

    public function testInsertLigneLivraison()
    {
        $data = [
            'bon_livraison_id' => $this->dummyBonLivraisonId,
            'article_id'       => $this->dummyArticleId,
            'description'      => 'Widget Type A',
            'quantite_livree'  => 10,
        ];
        $result = $this->model->insert($data);

        $this->assertIsNumeric($result);
        $this->assertGreaterThan(0, $result);
        $this->seeInDatabase('ligne_livraison', ['id' => $result, 'quantite_livree' => 10]);
    }

    public function testValidationFailsWithoutBonLivraisonId()
    {
        $data = [
            // 'bon_livraison_id' missing
            'article_id'       => $this->dummyArticleId,
            'description'      => 'Widget Type B',
            'quantite_livree'  => 5,
        ];
        $result = $this->model->insert($data);

        $this->assertFalse($result);
        $errors = $this->model->errors();
        $this->assertArrayHasKey('bon_livraison_id', $errors);
    }
    
    public function testFindLigneLivraison()
    {
         $data = [
            'bon_livraison_id' => $this->dummyBonLivraisonId,
            'article_id'       => $this->dummyArticleId,
            'description'      => 'Find Me',
            'quantite_livree'  => 15,
        ];
        $insertedId = $this->model->insert($data);

        $found = $this->model->find($insertedId);

        $this->assertIsArray($found);
        $this->assertEquals($insertedId, $found['id']);
        $this->assertEquals('Find Me', $found['description']);
    }

     public function testUpdateLigneLivraison()
    {
         $data = [
            'bon_livraison_id' => $this->dummyBonLivraisonId,
            'article_id'       => $this->dummyArticleId,
            'description'      => 'Update Me',
            'quantite_livree'  => 20,
        ];
        $insertedId = $this->model->insert($data);

        $updateData = ['quantite_livree' => 25, 'description' => 'Updated Description'];
        $result = $this->model->update($insertedId, $updateData);

        $this->assertTrue($result);
        $this->seeInDatabase('ligne_livraison', [
            'id' => $insertedId,
            'quantite_livree' => 25,
            'description' => 'Updated Description'
        ]);
    }

     public function testDeleteLigneLivraison()
    {
         $data = [
            'bon_livraison_id' => $this->dummyBonLivraisonId,
            'article_id'       => $this->dummyArticleId,
            'description'      => 'Delete Me',
            'quantite_livree'  => 5,
        ];
        $insertedId = $this->model->insert($data);

        $this->seeInDatabase('ligne_livraison', ['id' => $insertedId]);

        $result = $this->model->delete($insertedId);

        $this->assertTrue($result);
        $this->dontSeeInDatabase('ligne_livraison', ['id' => $insertedId]);
    }
} // This is the correct closing brace for the class