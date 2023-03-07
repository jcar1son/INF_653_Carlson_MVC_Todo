<?php

//The function to delete selected the category
function cat_del($cat_id){

    global $db;
    $query = "DELETE FROM categories WHERE categoryID = $cat_id";
    get_all($query, $db);

}

//the function to add a new category
function cat_add($cat_name){

    global $db;
    $query = "INSERT INTO categories(categoryName) VALUES ('" . addslashes($cat_name) . "')";
    get_one($query, $db);

}


?>