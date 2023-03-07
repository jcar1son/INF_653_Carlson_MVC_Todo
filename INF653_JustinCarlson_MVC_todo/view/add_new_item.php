<?php

require("view/header.php");
//redo

    //pulls all of the categories from the database
    $query = "SELECT * FROM categories ORDER BY categoryID";
    $cats = get_all($query, $db);

    
    //heading for adding adding an item to a cateogry
    //uses for each to get the categories into the drop down list
    echo "<h1 class = 'button'>Add Item</h1>
            <form class = 'button' action = 'index.php' method = 'POST'> <label>Category:</label><select name = 'category_id'>";

                foreach ($cats as $cat) :
                    echo "<option value = " . $cat['categoryID'] . ">";
                    echo $cat["categoryName"];
                    echo "</option>";
                endforeach;

    //forums for the title and description of the items
    //then a button to submit the new item
    echo    "</select><br><br><label>Title:</label>

                <input type = 'text' name = 'title' required /><br><br><label>Description</label>

                <input type = 'text' name = 'description' required /><br><br><label>&nbsp</label>

                <input type = 'submit' name = 'new_item' value = 'Add the new item' />

            </form>
                <p class = 'button'><a href = 'index.php'>View the To Do List</a></p>";

    require("view/footer.php");
?>