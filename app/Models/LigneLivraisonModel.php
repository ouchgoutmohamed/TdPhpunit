<?php

namespace App\Models;

use CodeIgniter\Model;

class LigneLivraisonModel extends Model
{
    protected $table            = 'ligne_livraison';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false; // Set to true if you want soft deletes
    protected $protectFields    = true;
    protected $allowedFields    = ['bon_livraison_id', 'article_id', 'description', 'quantite_livree'];

    // Dates
    protected $useTimestamps = true; // Set to true to automatically manage created_at and updated_at
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at'; // Uncomment if using soft deletes

    // Validation
    protected $validationRules      = [
        'bon_livraison_id' => 'required|integer|greater_than[0]',
        'article_id'       => 'required|integer|greater_than[0]',
        'quantite_livree'  => 'required|integer|greater_than_equal_to[0]', // Allow 0 if needed
        'description'      => 'permit_empty|string|max_length[255]',
    ];
    
   
}