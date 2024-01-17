<!DOCTYPE html>
<html lang="en">
<head>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD App</title>
    <style>
nav form{
    display: inline-block;
}
nav button{
    height:60%;
    padding:20px;
    font-size:25px;
    background-color:lightgrey;
}
form legend {
    font-size:25px;
    font-family: arial;
}
form fieldset {
    font-size:15px;
    font-family: arial;
    line-height:20px;
    background-color:lightgrey;


}
.buttonarea {
    margin-bottom:1%

}
table {
        width: 100%;
        border-collapse: collapse;
        background-color:white;

        }

        table img {
            width: 70%;
            height: 20vh
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 2px solid #ddd;
            font-size:25px;
            font-family:arial;
        }

        th {
            background-color: lightgrey;
        }
</style>
</head>
<body>
<h1>CRUD App Meny</h1>
    <nav>
       <form action="add_product.php"><button type="submit">Lägg till produkt</button></form>
       <form action="view_products.php"><button type="submit">Se alla produkter</button></form>
       <form action="edit_product.php"><button type="submit">Ändra pris/bild på produkt</button></form>
    </nav>

<!-- This block of code is based on functions that ensure that you can change the product you have already added ------------->

<?php
// Here it connects to the database that I created according to the instructions that I wrote in the indexes.
// These variables are defined to be able to connect to a database (MySql database) as they are the server names, usernames,
// password and database name ($dbname).$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_app";

// Using the defined variables, here I create a new connection to the created MySQL database.
$conn = new mysqli($servername, $username, $password, $dbname);

// Here it sends an error message if the connection fails.
if ($conn->connect_error) {
    die("Anslutning misslyckades: " . $conn->connect_error);
}

// Here it checks if the HTTP POST request has been sent to the page.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // These variables are values ​​retrieved from the form field. This will contain values ​​of those variables that are
    // mentioned below on the new product.
    $id = $_POST["id"];
    $price = $_POST["price"];
    $image = $_POST["image"];

// Check if a file was uploaded.
if (isset ($_FILES ["image"]) && !empty($_FILES["image"]["tmp_name"])){
    $image = $_FILES["image"]['name'];
    $tmpname = $_FILES['image']['tmp_name'];


    if (move_uploaded_file($tmpname, "../img/$image")){
        // File uploaded succesfully
    } else {
        $error = error_get_last();
        echo "Error: " . $error['message'];

    }
} else {
    // Handle the case where no file was uploaded.
     $image = ""; // or set it to the existing image filename if needed
}

    $sql = "UPDATE products SET price = '$price', image = '$image' WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Produktuppgifter uppdaterades framgångsrikt";
    } else {
        echo "Fel: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>




    <h1>Ändra pris och bild på produkten</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <fieldset>
    <legend>Uppdatera produkten här:</legend>
        Produkt ID: <br>
        <input type="number" name="id" required><br>
        Pris: <br>
        <input type="number" name="price" step="0.01" required><br>
        Bild: <br>
        <div class = "buttonarea">
        <input type="file" name="image"><br>
        </div>
        <input type="submit" value="Uppdatera produktuppgifter">
    </fieldset>
    </form>
<!-- Change product section ends here ------------------------------------------------------------------------------------->

<!-- This block of code builds on functions that display all the products one has added from the form field------------------->
    
<?php
// Here it connects to the database that I created according to the instructions that I wrote in the indexes.
// These variables are defined to be able to connect to a database (MySql database) as they are the server names, usernames,
// password and database name ($dbname). 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_app";

// Using the defined variables, here I create a new connection to the created MySQL database.
$conn = new mysqli($servername, $username, $password, $dbname);

// Here it sends an error message if the connection fails.
if ($conn->connect_error) {
    die("Anslutning misslyckades: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

// Here it is an if and an else statement with a while loop, which here builds a table that includes a product you have
// added. If the product is successfully added, it will appear in a table, but if it fails, no table will appear
// displayed at all.
if ($result->num_rows > 0) {
    echo "<h1>Lista över produkter</h1>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Namn</th><th>Beskrivning</th><th>Pris</th><th>Bild</th><th>Remove</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "<td>$" . $row["price"] . "</td>";
        echo "<td><img src='../img/" . $row["image"] . "'></td>";
        echo "<td><a href='delete_product.php?id=" . $row["id"] . "'><i class='fa fa-trash-o' style='font-size:48px;color:red'></i>
        </a></td>"; // Here it adds a delete button with the trashcan icon for each product added to the table.
        // The button is linked to another php file that has built-in functions to be able to remove a product. More
        // explanation is in the delete_product file
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Inga produkter hittades.";
}

$conn->close();
?>

<!-- Show product part ends here------------------------------------------------------------------------------------------->

</body>
</html>
