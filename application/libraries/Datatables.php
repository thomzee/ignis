<?php
/**
 * Created by PhpStorm.
 * User: thomzee
 * Date: 28/01/18
 * Time: 10.04
 */

class Datatables extends CI_Model {
    public $dt;
    public $sql;
    public $columns;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function generate(){
        /* PREPARE DATA */
        $sql = $this->sql;
        $db_result = $sql['result'];
        $db_query = $sql['queries']->queries[1];
        $db_columns = $this->columns;
        $db_rows_count = $db_result->num_rows();

        $this->dt_column_count = count($db_columns);
        $this->dt_search = $this->dt['search']['value'];

        /* SEARCH */
        $where = '';
        if ($this->dt_search != '') {
            foreach ($this->dt['columns'] as $key => $value){
                if(array_key_exists($key, $db_columns)){
                    if($value['searchable'] !== "false"){
                        $where .= $value['data'] .' LIKE \'%'. $this->dt_search .'%\'';
                        if ($key < $this->dt_column_count - 1) {
                            $where .= ' OR ';
                        }
                    }
                }
            }
        }

        if ($where != '') {
            if(strpos($db_query, 'WHERE') !== false){
                $db_query .= " AND " . $where;
            }else{
                $db_query .= " WHERE " . $where;
            }

            $db_rows_count = $this->db->query($db_query)->num_rows();
        }

        /* SORTING */
        $dtColumns = [];
        foreach ($this->dt['columns'] as $column){
            if($column['orderable'] !== "false"){
                $dtColumns[] = $column['data'];
            }else{
                $dtColumns[] = null;
            }
        }
        $db_query .= " ORDER BY {$dtColumns[$this->dt['order'][0]['column']]} {$this->dt['order'][0]['dir']}";

        /* LIMIT */
        $start  = $this->dt['start'];
        $length = $this->dt['length'];
        $db_query .= " OFFSET {$start} LIMIT {$length}";

        $return['list'] = $this->db->query($db_query);
        $return['columns'] = $db_columns;
        $return['columns_count'] = $dtColumns;
        $return['rows_count'] = $db_rows_count;
        $return['draw'] = $this->dt['draw'];
        $return['start'] = $this->dt['start'];

        return $return;
    }
}