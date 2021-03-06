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
    private $fields;
    private $selected_tables;

    public function __construct( $pname ) {
        $this->name = $pname;
    }

	public function set_fields( $pfields) {
	    $this->fields = $pfields;
	}

	public function get_fields() {
	    return $this->fields;
	}

}

?>

```

















