<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_User_management extends CI_Migration {
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

        // Dumping data for table 'menus'
        $data = array(
            'parent_id'     => null,
            'name'          => 'Dashboard',
            'slug'          => toSlug('Dashboard'),
            'icon'          => 'fa fa-chevron-right',
            'controller'    => 'Dashboard',
            'model'         => 'Dashboard_model',
            'sequence'      => 1,
            'created_at'    => date('Y-m-d H:i:s'),
        );
        $this->db->insert('menus', $data);
        $user = $this->db->insert_id();

        $data = array(
            'parent_id'     => NULL,
            'name'          => 'User Management',
            'slug'          => null,
            'icon'          => 'fa fa-folder',
            'controller'    => NULL,
            'model'         => NULL,
            'sequence'      => 1,
            'created_at'    => date('Y-m-d H:i:s'),
        );
        $this->db->insert('menus', $data);
        $user_management = $this->db->insert_id();

        $data = array(
            'parent_id'     => $user_management,
            'name'          => 'Users',
            'slug'          => toSlug('Users'),
            'icon'          => 'fa fa-chevron-right',
            'controller'    => 'Users',
            'model'         => 'Users_model',
            'sequence'      => 1,
            'created_at'    => date('Y-m-d H:i:s'),
        );
        $this->db->insert('menus', $data);
        $user = $this->db->insert_id();
    }

    public function down() {
        $this->dbforge->drop_table('menus', TRUE);
    }
}