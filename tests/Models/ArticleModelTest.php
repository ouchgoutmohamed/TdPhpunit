<?php

namespace Tests\Models;

use App\Models\ArticleModel;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;

class ArticleModelTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $namespace   = 'App';   
    protected $model;
    protected $refresh = true;
    
    protected function setUp(): void
    {
        parent::setUp();
        $this->model = new ArticleModel();
    }
    
    public function testReferenceIsRequired()
    {
        // Test qu'un article sans référence est invalide
        $data = [
            'libelle' => 'Test Article',
            'quantite_commande' => 10
        ];
        
        $result = $this->model->insert($data);
        $this->assertFalse($result);
        
        $errors = $this->model->errors();
        $this->assertArrayHasKey('reference', $errors);
    }
    
    public function testQuantiteCommandeIsRequired()
    {
        // Test qu'un article sans quantité commandée est invalide
        $data = [
            'reference' => 'REF123',
            'libelle' => 'Test Article'
        ];
        
        $result = $this->model->insert($data);
        $this->assertFalse($result);
        
        $errors = $this->model->errors();
        $this->assertArrayHasKey('quantite_commande', $errors);
    }
    
    public function testValidArticleCanBeInserted()
    {
        // Test qu'un article valide peut être inséré
        $data = [
            'reference' => 'REF123',
            'libelle' => 'Test Article',
            'quantite_commande' => 5
        ];
        
        $result = $this->model->insert($data);
        $this->assertIsNumeric($result);
        $this->assertGreaterThan(0, $result);
    }
}