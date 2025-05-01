<?php
namespace Tests\Models;

use App\Models\PanierModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class PanierModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $namespace   = 'App';
    protected $model;
    protected $refresh = true; 

    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new PanierModel();
    }
    public function testInsertPanier()
    {
        $data = [
            'user_id'    => 9,
            'article_id' => 101,
            'quantite'   => 5,
            'date_ajout' => date('Y-m-d H:i:s')
        ];
        $result = $this->model->insert($data);

        $this->assertIsNumeric($result);
        $this->assertGreaterThan(0, $result);

        $this->seeInDatabase('panier', ['id' => $result, 'user_id' => 9]);
    }

    public function testDeletePanierItem()
    {
        
        $data = [
            'user_id'    => 11,
            'article_id' => 103,
            'quantite'   => 1,
            'date_ajout' => date('Y-m-d H:i:s')
        ];
        $insertedId = $this->model->insert($data);

        
        $this->seeInDatabase('panier', ['id' => $insertedId]);
        $deleteResult = $this->model->delete($insertedId);
        $this->assertTrue($deleteResult);

        $this->dontSeeInDatabase('panier', ['id' => $insertedId]);
    }

    
    public function testValidationFailsWithInvalidData()
    {
        $data = [
            'user_id'    => 12,
            'article_id' => 104,
            'quantite'   => 0, // Invalid quantity based on validation rule
            'date_ajout' => date('Y-m-d H:i:s')
        ];

        
        $result = $this->model->insert($data, false); // Set second param to false to get validation errors

        $this->assertFalse($result);
        $errors = $this->model->errors();
        $this->assertArrayHasKey('quantite', $errors); // Check if 'quantite' field has a validation error
    }

    public function testUpdatePanierItemQuantity()
    {
        // First, insert an item
        $initialData = [
            'user_id'    => 13,
            'article_id' => 105,
            'quantite'   => 2,
            'date_ajout' => date('Y-m-d H:i:s')
        ];
        $insertedId = $this->model->insert($initialData);
        $updateData = [
            'quantite' => 10 // New quantity
        ];

        $updateResult = $this->model->update($insertedId, $updateData);

        $this->assertTrue($updateResult);

        $this->seeInDatabase('panier', ['id' => $insertedId, 'quantite' => 10]);

        $updatedItem = $this->model->find($insertedId);
        $this->assertEquals($initialData['user_id'], $updatedItem['user_id']);
        $this->assertEquals($initialData['article_id'], $updatedItem['article_id']);
    }
}