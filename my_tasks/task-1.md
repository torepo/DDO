# Task 1: 

I want to achieve something like code below:

```
<?php
    // create database    
    $dbo = new DDO( $phost, $puser, $ppassword, $pdatabase );

    // select a table from database
    $table = $dbo->select_table( $ptable_name );

    // create select query
    $query = $dbo->create_query( $table, DDO::SELECT_QRY );
    
    // define result
    $query->set_result( DDO::SINGLE_ROW, $pstr_ret_collum, $pstr_criteria );

    // get resuls
    $row = $query->execute();
?>

```

# Solution: 

First, I create a file named: DDO.php. Then, create a class name: DDO.

So, I created:

```
<?php

    /** 
      *  DDO class for MySql Server
      */
    class DDO {
        // Code here
    } 
?>

```

**1. Creating Database**

My first attemps is to achieve:

```

//  create database    
    $dbo = new DDO( $phost, $puser, $ppassword, $pdatabase );
    
```

For this purpose, DDO class would be:

```
<?php

    /** 
      *  DDO class for MySql Server
      */
    class DDO {
        public function __construct( $phost, $puser, $ppassword, $pdb_name ) {

         // SET DATABASE PROPERTY...
        $this->host = $phost;
        $this->db_name = $pdb_name;
        $this->user = $puser;
        $this->password = $ppassword;
        }
    } 
?>
```

And the task is done..

**2. Select a table from database**

Here is the goal:

```
// select a table from database
   $table = $dbo->select_table( $ptable_name );
   
```

For that purpose,

1. Adding select_table method to DDO class.
2. Select table means that DDO class have tables property. So, i will adding tables property into the class. This property will be an array that contain all tables in the database.

Then, DDO class became:

```
<?php
    /** 
      *  DDO class for MySql Server
      */
    class DDO {
        private $host;
        private $db_name;
        private $user;
        private $password;
    
        private $tables;    // an array of tables 
    
        public function __construct( $phost, $puser, $ppassword, $pdb_name ) {

         // SET DATABASE PROPERTY...
        $this->host = $phost;
        $this->db_name = $pdb_name;
        $this->user = $puser;
        $this->password = $ppassword;
        }
        
        // PICK A TABLE FROM DATABASE,
        // RETURN AN TABLE OBJECT
        public function select_table( $ptable_name ) {

            foreach( $this->tables as $ltable ) {
                if( $ltable->name == $ptable_name ) {
                    return $this->selected_tables = $ltable;
                } 
           }
       }
    } 
?>

```

So now, we just added tables property and select_table method to the class. As you see, we must have table object for the select_table. So I create a class name Tables to handle it. Here is the table class:

```
<?php

class Tables {
    public $name;
    public $fields;
	
	public function __construct( $p_name ) {
	    //$this->set_fields( $p_fields );
		$this->set_table_name( $p_name );
	}
	
	private function set_table_name( $p_name ) {
	    $this->name = $p_name;
    }

	public function set_fields( $p_fields) {
	    $this->fields = $p_fields;
	}
    
	// THIS FUNCTION WILL CONSTRUCT STRING FIELD WITH FORM:
	// 'FIELD_1, FIELD_2,...,FIELD_N'
    private function get_string_field() {
	    return implode( ', ', $this->fields );
    }
	
	  // THIS FUNCTION WILL CONSTRUCT STRING PARAM WITH FORM:
	  // '?, ?,...,?'
	private function get_string_param() {
	    $param = [];
        for ( $i = 0; $i < count( $this->fields ); $i++ ) {
            $param[ $i ] = ':'.$this->fields[ $i ];
        }
		 
		return implode( ', ', $param );
	}

    public function set_table_fields( $p_fields ) {
        $this->fields = $p_fields;
    }
	
	// FORM INSERT SQL STRING 
    public function get_insert_sql() {
	
        $insert_sql = "INSERT INTO ".$this->name."(". $this->get_string_field().
		    ") VALUES (".$this->get_string_param().")";
			
	    return $insert_sql;
    }
	
	// FORM UPDATE SQL STRING
	public function get_update_sql( $str_param, $str_criteria ) {

        // $str_param FORM: 'FIELD_1=SOME VALUE, FIELD_2=SOME VALUE..
        // $str_criteria FORM: 'FIELD_1=? AND FIELD_N=?; 
        $update_sql = "UPDATE ".$this->name." SET ".$str_param." WHERE ".$str_criteria;

        return $update_sql;
	}

    // CONSTRUCT DELETE TABLE DATA SQL
    public function get_delete_sql( $str_critera ) {

       $delete_sql = "DELETE*FROM ".$this->name." WHERE ".$str_criteria;

       return $delete_sql;
    }

    // CONSTRUCT SELECT TABLE DATA SQL
    public function get_select_sql( $str_field, $str_criteria ) {
    
        $select_sql = "SELECT ".$str_field." FROM ".$this->name." WHERE ".$str_criteria;
        
        return $select_sql;
    }
}

```

















