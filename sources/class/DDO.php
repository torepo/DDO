<?php

include_once 'tables.php';
include_once 'query_php';

class DDO {

    const COL_ALL = 1;
    const SELECT_QRY = 2;
    const SINGLE_ROW = 3;

    private $host;
    private $db_name;
    private $user;
    private $password;
    private $PDO;    // we don't want PDO access directly by the pubic
    private $tables;    // TEMPORARY SET TO PRIVATE SCOPE
    public $query;  

    //  WE SIMPLIFY INSTANTIATION OF THE OBJECT
    //  INSTANTIATION ONLY NEED TO PASS PARAMETER VALUE 
    public function __construct( $phost, $puser, $ppassword, $pdb_name ) {

        // SET DATABASE PROPERTY...
        $this->host = $phost;
        $this->db_name = $pdb_name;
        $this->user = $puser;
        $this->password = $ppassword;

        // SET PDO OBJECT PROPERTY
        $this->set_PDO();

       // SET TABLES OBJECT PROPERTY
       $this->set_tables();

    }

    private function set_property() {
    }

   // SET PDO PROPERTY FOR THE CLASS, THIS PROPERTY IS AN OBJECT
    private function set_PDO() {   // direct used by: __construct,  

        try {

        // SET PDO PROPERTY FOR MYSQL SERVER
        $this->PDO = new PDO( "mysql:host=".$this->host.";dbname=".
            $this->db_name, $this->user, $this->password );
            
            //echo 'TESTING!!: Connection established <br>';    
            return $this->PDO;
        }
        catch ( PDOException $e ) {
            echo $e->getMessage();
        }
    }

    // ENABLED PUBLIC TO SELECT DATABASE
    public function select_db( $pdb_name ){    // DIRECT USED BY by: none,     

        return $this->PDO->select_db( $pdb_name );
    }

    // RETURN AN ARRAY OF A TABLE FIELDS NAME
    private function get_table_colums_name( $ptable_name ){    // DIRECT USED by: set_tables

       $stmt = $this->PDO->prepare( "DESCRIBE $ptable_name" );
       $stmt->execute(); 
       $table_colums_name = $stmt->fetchAll( PDO::FETCH_COLUMN );

       return $table_colums_name; 
    }

    // RETURN AN ARRAY OF TABLES NAME
    // DIRECT USED BY: set_tables
    private function get_tables_name() {

        $tables_name = [];

        $all_tables = $this->PDO->query( "show tables", PDO::FETCH_NUM );
        
        while( $result = $all_tables->fetch() ) {

            array_push( $tables_name, $result[ 0 ] );
        }

        return $tables_name; 
    }

    // SET TABLES PROPERTY,
    // PROPERTY IS AN ARRAY OF OBJECTS,
    // DIRECT USED BY: __construct
    private function set_tables() {

        $tables = [];

        //GET TABLES NAME
        $tables_name = $this->get_tables_name();

        // LOOP THROUGH TABLE...
        for( $i = 0; $i < count( $tables_name ); $i++ ) {

            // GET TABLE COLUM NAME
            $lcolums = $this->get_table_colums_name( $tables_name[ $i ] );

            // CREATE DATA BASE TABLE OBJECT
            $table = new Tables( $tables_name[ $i ] );
            $table->set_fields( $lcolums );

           // STORE TABLES IN ARRAY
           array_push( $tables, $table ); 
        }

        //echo 'TESTING!! : '. var_dump( $tables );
        return $this->tables = $tables; 
    }

    // PICK A TABLE FROM DATABASE,
    // RETURN AN TABLE OBJECT
    // DIRECT USED BY : none
    public function select_table( $ptable_name ) {

        foreach( $this->tables as $ltable ) {
            if( $ltable->name == $ptable_name ) {
                return $this->selected_tables = $ltable;
            } 
        }
    }

    // CREATE A QUERY
    public function create_query( $pquery_type ) {

        return $this->query = new Query( $pquery_type, $this->selected_tables );
    }
}

?>
