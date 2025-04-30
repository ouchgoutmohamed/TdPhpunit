<?php
// filepath: c:\Users\AdMin\Documents\ingenerie-logiciel\master\2s\devops\projetdevops\codeigniter\app\Database\Migrations\YYYY-MM-DD-HHMMSS_CreatePanierTable.php


namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePanierTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'produit_id' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'quantite' => [
                'type'       => 'INT',
                'constraint' => 5,
                'default'    => 1,
            ],
            'date_ajout' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            
        ]);
        $this->forge->addKey('id', true); // Primary Key
        $this->forge->createTable('panier');
    }

    public function down()
    {
        $this->forge->dropTable('panier');
    }
}