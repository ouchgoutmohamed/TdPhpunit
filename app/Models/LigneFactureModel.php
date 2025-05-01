<?php
namespace App\Models;

use CodeIgniter\Model;


class LigneFactureModel extends Model
{
    protected $table = 'ligne_facture';
    protected $primaryKey = 'id';
    protected $allowedFields = ['facture_id', 'description', 'quantite', 'prix_unitaire'];

    protected $storage = [];

    public function setStorage(array $storage)
    {
        $this->storage = $storage;
    }

    public function ajouterLigne(array $ligne)
    {
        $this->storage[] = $ligne;
    }

    public function getLignes(): array
    {
        return $this->storage;
    }

    public function supprimerLigne($description)
    {
        foreach ($this->storage as $index => $ligne) {
            if ($ligne['description'] === $description) {
                unset($this->storage[$index]);
                $this->storage = array_values($this->storage);
                break;
            }
        }
    }

    public function viderLignes()
    {
        $this->storage = [];
    }
}
