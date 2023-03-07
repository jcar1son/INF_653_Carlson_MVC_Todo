<?php

    include("view/header.php");

// We create a table for the list of catagories and items

    echo "<h2 class = 'button'>The Category List</h2>
          <table>
                <tr>
                    <th colspan = '3'>Name</th>
                </tr>";

                //we create a query look at the current cateogries
                $query = "SELECT * FROM categories ORDER BY categoryID ASC";
                $cats = get_all($query, $db);
                $count = 1;

                //then we use a for each to output the current list of categories
                foreach ($cats as $cat) :
                    echo "<form action = 'index.php' method = 'POST'>
                            <input type = 'number' name = 'del' value = " . $cat["categoryID"] . " style = 'visibility: hidden;' />
                                <tr>
                                    <td>" . $cat["categoryName"] . "</td>
                                    <td><input type = 'submit' name = 'delete_cat' value = 'Delete' /></td>
                                </tr>
                          </form>";
                          $count++;
                endforeach;

                //query for altering the table
                $query = "ALTER TABLE categories AUTO_INCREMENT = $count";
                get_one($query, $db);

        //End table with adding a new category
       echo  "</table>

           <h2 class = 'button'>Add Category</h2>
           <form class = 'button' action = 'index.php' method = 'POST'>
                <label>Name:</label>
                <input type = 'text' name = 'category_name' required />
                <input type = 'submit' name = 'add_cat' value = 'Add Category' />
           </form>";

    echo "<p class = 'button'><a href = 'index.php'>View To Do List</a></p>";

    //ending footer
    include("view/footer.php");
?>