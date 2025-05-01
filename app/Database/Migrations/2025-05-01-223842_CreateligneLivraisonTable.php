<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLigneLivraisonTable extends Migration
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
            'bon_livraison_id' => [ // Foreign key to bonlivraisons table
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'article_id' => [ // Foreign key to an assumed articles table
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
            ],
            'description' => [ // Description of the article delivered
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true, // Or false if always required
            ],
            'quantite_livree' => [
                'type'       => 'INT',
                'constraint' => 5,
                'unsigned'   => true,
                'default'    => 0,
            ],
            // Add timestamp columns
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            // ...existing code...
        ]);
        $this->forge->addKey('id', true); // Primary Key
        // Add foreign key constraints if the related tables exist
        // $this->forge->addForeignKey('bon_livraison_id', 'bonlivraisons', 'id', 'CASCADE', 'CASCADE');
        // $this->forge->addForeignKey('article_id', 'articles', 'id', 'CASCADE', 'CASCADE'); // Assuming an 'articles' table
        $this->forge->createTable('ligne_livraison');
    }

    public function down()
    {
        $this->forge->dropTable('ligne_livraison');
    }
}