<?php

namespace App\Models;

use CodeIgniter\Model;

class PanierModel extends Model
{
    protected $table      = 'panier';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType     = 'array';
    protected $allowedFields = ['user_id', 'article_id', 'quantite', 'date_ajout'];
    protected $validationRules = [
        'user_id'    => 'required|integer|greater_than[0]',
        'article_id' => 'required|integer|greater_than[0]',
        'quantite'   => 'required|integer|greater_than_equal_to[1]',
        'date_ajout' => 'required|valid_date[Y-m-d H:i:s]',
    ];
}