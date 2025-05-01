<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BonLivraisonSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'dateLivraison' => '2023-10-01',
                'adresseLivraison' => '123 Main St, Cityville',
                'etat' => 'en cours'
            ],
            [
                'dateLivraison' => '2023-10-02',
                'adresseLivraison' => '456 Elm St, Townsville',
                'etat' => 'livré'
            ],
            [
                'dateLivraison' => '2023-10-03',
                'adresseLivraison' => '789 Oak St, Villagetown',
                'etat' => 'annulé'
            ]
        ];

        // Using Query Builder
        $this->db->table('bonlivraisons')->insertBatch($data);
    }
}
