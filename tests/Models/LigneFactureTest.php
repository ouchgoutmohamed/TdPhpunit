<?php
namespace Tests\Support\Models;

use CodeIgniter\Test\CIUnitTestCase;
use App\Models\LigneFactureModel;

class LigneFactureTest extends CIUnitTestCase
{
    protected $ligneFactureModel;

    protected function setUp(): void
    {
        parent::setUp();
        $this->ligneFactureModel = new LigneFactureModel();
        $this->ligneFactureModel->setStorage([]);  // Initialise le stockage
    }

    public function testAjouterLigne()
    {
        $ligne = [
            'facture_id'    => 1,
            'description'   => 'Service A',
            'quantite'      => 2,
            'prix_unitaire' => 100
        ];

        // Ajouter la ligne
        $this->ligneFactureModel->ajouterLigne($ligne);

        // Vérifier que la ligne a bien été ajoutée
        $lignes = $this->ligneFactureModel->getLignes();
        $this->assertCount(1, $lignes);
        $this->assertEquals($ligne, $lignes[0]);
    }

    public function testSupprimerLigne()
    {
        $ligne = [
            'facture_id'    => 1,
            'description'   => 'Service A',
            'quantite'      => 2,
            'prix_unitaire' => 100
        ];

        $this->ligneFactureModel->ajouterLigne($ligne);

        // Supprimer la ligne
        $this->ligneFactureModel->supprimerLigne('Service A');

        // Vérifier que la ligne a été supprimée
        $lignes = $this->ligneFactureModel->getLignes();
        $this->assertCount(0, $lignes);
    }

    public function testViderLignes()
    {
        $ligne = [
            'facture_id'    => 1,
            'description'   => 'Service A',
            'quantite'      => 2,
            'prix_unitaire' => 100
        ];

        $this->ligneFactureModel->ajouterLigne($ligne);

        // Vider toutes les lignes
        $this->ligneFactureModel->viderLignes();

        // Vérifier que toutes les lignes ont été supprimées
        $lignes = $this->ligneFactureModel->getLignes();
        $this->assertCount(0, $lignes);
    }
}