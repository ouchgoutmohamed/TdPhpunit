<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBonLivraisonTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'dateLivraison' => [
                'type'       => 'DATETIME',
                'null'       => false,
            ],
            'adresseLivraison' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false,
            ],
            'etat' => [
                'type'       => 'ENUM',
                'constraint' => ['en cours', 'livré', 'annulé'],
                'default'    => 'en cours',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bonlivraisons');
    }

    public function down()
    {
        $this->forge->dropTable('bonlivraisons');
    }
}
