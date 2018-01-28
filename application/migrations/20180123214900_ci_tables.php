<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Ci_tables extends CI_Migration {
    public function up()
    {
        /*===================== ci_sessions (postgre) =====================*/
        $raw = 'CREATE TABLE "ci_sessions" (';
            $raw .= '"id" varchar(128) NOT NULL,';
            $raw .= '"ip_address" varchar(45) NOT NULL,';
            $raw .= '"timestamp" bigint DEFAULT 0 NOT NULL,';
            $raw .= '"data" text DEFAULT \'\' NOT NULL';
        $raw .= ');';
        $this->db->query ( $raw );

        $raw = 'CREATE INDEX "ci_sessions_timestamp" ON "ci_sessions" ("timestamp");';
        $this->db->query ( $raw );
    }

    public function down() {
        $this->dbforge->drop_table('ci_sessions', TRUE);
    }
}