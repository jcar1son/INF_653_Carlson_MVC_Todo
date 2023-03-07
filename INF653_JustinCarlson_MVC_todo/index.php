<?php
    //required databases for the index
    require('model/data.php'); 
    require('model/item_data.php'); 
    require('model/cat_data.php');


    //filter input
    $todoitem_id = filter_input(INPUT_POST, "todoitem_id", FILTER_VALIDATE_INT);
    $title = filter_input(INPUT_POST, "title", FILTER_UNSAFE_RAW);
    $description = filter_input(INPUT_POST, "description", FILTER_UNSAFE_RAW);
    $category_name = filter_input(INPUT_POST, "category_name", FILTER_UNSAFE_RAW);

    $category_id = filter_input(INPUT_POST, "category_id", FILTER_VALIDATE_INT);
    if (!$category_id) {
        $category_id = filter_input(INPUT_GET, "category_id", FILTER_VALIDATE_INT);
    }

    $action = filter_input(INPUT_POST, "action", FILTER_UNSAFE_RAW);
    
    if (!$action) {
        $action = filter_input(INPUT_GET, "action", FILTER_UNSAFE_RAW);

        if(!$action) {

            $action = "list_todoitems";

        }
    }
    
    if (isset($_POST["add_item"])){

        include('view/add_new_item.php');

    }

    //adding a new category
    if (isset($_POST["add_cat"])){

        cat_add($_POST["category_name"]);

    }

    //if the user wants to edit and add an item
    if (!isset($_POST["add_item"]) && !isset($_POST["ve_cat"])){

        include("view/view_item.php");

    }

    //sets the item added
    if (isset($_POST["new_item"])){

        add_item($_POST["category_id"], $_POST["title"], $_POST["description"]);

    }

    //if the user wants to delete an item
    if (isset($_POST["delete_item"])){

        delete_item($_POST["del"]);

    }

    //if the user wants to delete a category
    if (isset($_POST["delete_cat"])){

        cat_del($_POST["del"]);

    }

    //if the user wants to look at the category list
    if (isset($_POST["ve_cat"])){

        include("view/cat_list.php");

    }

?>