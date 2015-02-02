<?php

class Query {

     private $query_type;
     private $sources_table;
     private $cons_row;
     private $cons_col;
     private $str_criteria;

     public function __construct( $pquery_type, $psources_table ) {
     
         $this->query_type = $pquery_type;
         $this->sources_table = $psources_table;
     }

     private function get_select_string() {

         if( $this->cons_col == DDO::COL_ALL ) {

             $select_sql = "SELECT*FROM ".$this->sources_table->name." WHERE ".$this->str_criteria;
        
             return $select_sql;
         }
     }

     private function get_sql_string() {

         if( $this->query_type == DDO::SELECT_QRY ) {

             //echo 'TESTING!!: '.$this->get_select_string().'<br>';
             return $this->get_select_string();
         }
     }

    public function set_result( $pcons_row, $pcons_col, $pstr_criteria ) {
         
         $this->cons_row = $pcons_row;
         $this->cons_col = $pcons_col;
         $this->str_criteria = $pstr_criteria;
     }

     public function execute() {
         $lsql_string = $this->get_sql_string();
     }
    
}
?>
