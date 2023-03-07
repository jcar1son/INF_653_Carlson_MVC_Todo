<?php
    //A function to delete a selected item in the list
    function delete_item($item_num){

        global $db;
        $query = "DELETE FROM todoitems WHERE ItemNum = $item_num";
        get_all($query, $db);

    }

    //function to add an item to the list
    //then activates the get function for the stream to the database
    function add_item($cat_id, $title, $desc){  

        global $db;
        $query = "INSERT INTO todoitems (categoryID, Title, Description) VALUES ($cat_id, " . "'" . addslashes($title) . "'," . "'" . addslashes($desc) . "')";
        get_one($query, $db);

    }

    //function for getting all of the items 
    //queries and then closes the stream to the database
   function get_all($query, $db){

       $statement = $db -> prepare($query); 
       $statement -> execute();
       $result = $statement -> fetchAll(); 
       $statement -> closeCursor();
       return $result;

   }

   //function for getting one of the items 
   //queries and then closes the stream to the database
   function get_one($query, $db){

       $statement = $db->prepare($query); 
       $statement -> execute();
       $result = $statement -> fetch(); 
       $statement -> closeCursor();
       return $result;

   }
   
?>