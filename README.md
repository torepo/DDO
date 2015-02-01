# INTRODUCTION

First of all, I want to say that this project is only intended for learning and pleasure. Not for the purpose of production. I'm a beginner so please understand if you found many mistakes anywhere in my code, and of course for that I need your suggestion, comment and advice.

The main priority of this project is to try to simplifying writing PHP code for access to the MySql database. For this purpose I use PDO capability. 

The reason why I try to create this project is because I feel lazy to write code that I think long enough. So I was wondering if there is a shorter and simpler way to do it.

In addition, it is also a learning project for me to be familiar with OOP concepts especially in the PHP language.
OK, I just call this dabase object DDO. There is no meaning, just a name..

# REPOSITORY 

I create some folders in this repository so that files are well organized. Youn can view the full description for each folder on file [repository structure.md](https://github.com/torepo/DDO/blob/master/repository%20structure.md)

It should be noted, that I did this project step by step based on a task or solving problems that arise. So for that I create a folder called history. You can visit these folders if you want to know what the task is being done, the problem is happening.

# DDO OVERVIEW

As I said before, the main purpose of DDO is to simplify code writing when we want to interact with MySql. So that, DDO is dedicated for beginer. Surely, this object will have limited capability because of loosing flexsibility. But Mostly, for small projects we don't need flexibility. Instead, we need a simple line of code that easy to use.

So take a look for the code above:

```
<?php

    $dbo = new DDO( $phost, $puser, $ppassword, $pdatabase );
    
    $table = $my_dbo->select_table( $ptable_name );
    
    $query = $my_dbo->create_query( $table, DDO::SELECT_QRY );
    $query->set_result( DDO::SINGLE_ROW, $str_ret_collum, $str_criteria );

    $row = $query->execute();

?>

```
Does it looked easy and make sense? If the answer's yes. It will be a task to be done, and that is DDO intended for.  





