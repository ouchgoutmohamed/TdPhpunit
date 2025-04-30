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
            'produit_id' => 101,
            'quantite'   => 5,
            'date_ajout' => date('Y-m-d H:i:s')
        ];
        $result = $this->model->insert($data);

        $this->assertIsNumeric($result); 
        $this->assertGreaterThan(0, $result); 
        
    }
    
}