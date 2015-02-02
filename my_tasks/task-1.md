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

1. ##### Creating Database

My first attemps is to create 





