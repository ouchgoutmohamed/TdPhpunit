<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table      = 'articles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['reference', 'libelle', 'quantite_commande'];
    
    protected $validationRules = [
        'reference'         => 'required|alpha_numeric|min_length[3]|max_length[50]|is_unique[articles.reference,id,{id}]',
        'libelle'           => 'required|string|min_length[3]|max_length[255]',
        'quantite_commande' => 'required|integer|greater_than_equal_to[1]',
    ];
    
    protected $validationMessages = [
        'reference' => [
            'required' => 'La référence est obligatoire.',
            'is_unique' => 'Cette référence existe déjà.',
            'alpha_numeric' => 'La référence doit contenir uniquement des lettres et des chiffres.'
        ],
        'quantite_commande' => [
            'required' => 'La quantité commandée est obligatoire.',
            'greater_than_equal_to' => 'La quantité doit être au moins de 1.'
        ]
    ];
}