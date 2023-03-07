<?php
    require("view/header.php");

    //form for the categories
    //uses a for each to outputs the current used categories
    echo "<form class = 'button' id = 'cat_select' action = 'index.php' method = 'POST'>

        <label>Category:</label>

            <select name = 'select_cat'>
            <option value = 'all'>View All Categories</option>";
            $query = "SELECT * FROM categories ORDER BY categoryID ASC";
            $cats = get_all($query, $db);
            foreach ($cats as $cat) :
                echo "<option value = " . $cat['categoryID'] . ">";
                echo $cat["categoryName"];
                echo "</option>";
            endforeach;

    echo  "</select>
    <input type = 'submit' name = 'change_selection'>
    </form>";

    //table for adding the title and the description of the item added
    echo "<table>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th colspan = '3'>The Category</th>
    </tr>";
    
    //query for the database
    $query = "SELECT ItemNum, Title, Description, categoryID FROM todoitems ORDER BY ItemNum ASC";

    //selecting the category 
    if (isset($_POST["select_cat"]))
    {
        if ($_POST["select_cat"] != "all")
        {
            $value = $_POST["select_cat"];
            $query = "SELECT ItemNum, Title, Description, categoryID FROM todoitems WHERE categoryID = $value ORDER BY ItemNum ASC";
        }
    }

    //then outputs the results
    $results = get_all($query, $db);        
    $count = 1;

    //form for adding the title and description of the todo item
    //then checks for special chars
    foreach ($results as $result) :
        $category_id = $result["categoryID"];
        echo "<form action = 'index.php' method = 'POST'>
                    <input type = 'number' name = 'del' value = " . $result["ItemNum"] . " style = 'visibility: hidden;' />
                    <tr>
                        <td>"
                            . htmlspecialchars($result["Title"]) .
                        "</td>
                        <td>" .
                            htmlspecialchars($result["Description"]) . 
                        "</td>
                        <td>";

                        $query1 = "SELECT categoryName FROM Categories WHERE categoryID = $category_id";
                        $result1 = get_one($query1, $db);

        echo                htmlspecialchars($result1["categoryName"]) .
                        "</td>

                        <td>
                            <input type = 'submit' name = 'delete_item' value = 'Delete' />
                        </td>
                    </tr>
                </form>";
        $count++;
    endforeach;

    //then alters the table to the new items to the lists
    $query = "ALTER TABLE todoitems AUTO_INCREMENT = $count";
    get_one($query, $db);

    //end buttons to add the item or view the categories
    echo "</table>

    <form class = 'button' action = 'index.php' method = 'POST'>
        <input type = 'submit' name = 'add_item' value = 'Add the new item'>
    </form>
    <form class = 'button' action = 'index.php' method = 'POST'>
        <input type = 'submit' name = 've_cat' value = 'View or the Edit Categories'>
    </form>";

    require("view/footer.php");
?>