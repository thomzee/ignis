<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Menu extends CI_Migration {
    public function up()
    {
        /*===================== menus =====================*/
        // Drop table 'menus' if it exists
        $this->dbforge->drop_table('menus', TRUE);

        // Table structure for table 'menus'
        $this->dbforge->add_field(array(
            'id' => array(
                'type'           => 'MEDIUMINT',
                'constraint'     => '8',
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ),
            'parent_id' => array(
                'type'           => 'MEDIUMINT',
                'constraint'     => '8',
                'null'           => TRUE,
            ),
            'name' => array(
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ),
            'slug' => array(
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => TRUE,
            ),
            'controller' => array(
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => TRUE,
            ),
            'model' => array(
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => TRUE,
            ),
            'sequence' => array(
                'type'       => 'MEDIUMINT',
                'constraint' => '8',
                'null'       => TRUE,
            ),
            'icon' => array(
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => TRUE,
            ),
            'active' => array(
                'type'       => 'BOOL',
                'default'    => TRUE,
            ),
            'created_at' => array(
                'type'       => 'TIMESTAMP',
                'null'       => TRUE,
            ),
            'updated_at' => array(
                'type'       => 'TIMESTAMP',
                'null'       => TRUE,
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('menus');
    }

    public function down() {
        $this->dbforge->drop_table('menus', TRUE);
    }
}