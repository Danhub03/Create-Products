<!DOCTYPE html>
<html lang="en">
<head>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    padding:10px;
    width:15%;
    display:inline-block;



}
form textarea {
    width:80%;
    height:7vh;
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
            /* vertical-align:center; */
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
    

<!-- Denna block av kod bygger på funktioner till att kunna lägga till produkt via en formulärfält---------------------------->
    
<?php
// Här kopplar det upp mot databasen som jag skapade enligt instruktionerna som jag skrev i indexen.
// Dessa variabler är definierade för att kunna ansluta till en databas (MySql-databas) då det är servernamnen, användarnamn,
// lösenord och databasnamn ($dbname).
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud_app";

// Med hjälp av de definierade variablerna skapar jag här en ny anslutning till den skapade MySQL-databasen. 
$conn = new mysqli($servername, $username, $password, $dbname);

// Här skickar den ett felmeddelande om anslutningen misslyckas.
if ($conn->connect_error) {
    die("Anslutning misslyckades: " . $conn->connect_error);
}

// Här kontrollerar det om HTTP POST-förfrågan har skickats till sidan.
 if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    // Dessa variabler är värden som hämtas från formulärfältet. Detta kommer att innehålla värden av de variablerna som är
    // nämnda under på den nya produkten.
    $name = $_POST["name"];    
    $description = $_POST["description"];
    $price = $_POST["price"];
    $image = $_FILES["image"]["name"]; 
    $tmpname = $_FILES["image"]["tmp_name"];

    // Här flyttar den uppladdade bilden från det temporära platsen till det slutgiltiga mappen. Koden kommer köras inom den
    // den här if-satsen om uppladdningen misslyckas.
    if (!move_uploaded_file ($tmpname, "../img/$image")) {
        $error = error_get_last();
        echo "Error: " . $error["message"];
    }
     
    // Här skapas en SQL-förfrågan som lägger till produktinformationen i databastabellen "products." Värden som inkluderas i
    // produktinformationen är värden som hämtades från formuläret.
    $sql = "INSERT INTO products (`name`, `description`, `price`, `image`) VALUES ('$name', '$description', '$price', '$image')";

    // Om produkten lyckas läggas till så printar det ut att det lyckades annars kommer det ge fel.
    if ($conn->query($sql) === TRUE) {
        echo "Produkt lades till framgångsrikt";
    } else {
        echo "Fel: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>



    <h1>Lägg till produkt</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
    <fieldset>
    <legend>Lägg till produkt här:</legend>
        Namn: <br>
        <input type="text" name="name"  required><br>
        Beskrivning: <br>
        <textarea name="description"></textarea><br>
        Pris: <br>
        <input type="number" name="price" step="0.01" min = "1" required><br>
        Bild: <br>
        <div class = "buttonarea">
        <input type="file" name="image"><br>
        </div>
        <input type="submit" value="Lägg till produkt">
    </fieldset>
    </form>

  
<!-- Lägga till produkt delen slutar här-------------------------------------------------------------------------------------->

<!-- Denna block av kod bygger på funktioner som visar alla produkter man har lagt till från formulärfältet------------------->

    <?php
    // Här kopplar det upp mot databasen som jag skapade enligt instruktionerna som jag skrev i indexen.
    // Dessa variabler är definierade för att kunna ansluta till en databas (MySql-databas) då det är servernamnen, användarnamn,
    // lösenord och databasnamn ($dbname).
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crud_app";

    // Med hjälp av de definierade variablerna skapar jag här en ny anslutning till den skapade MySQL-databasen.
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Här skickar den ett felmeddelande om anslutningen misslyckas.
    if ($conn->connect_error) {
        die("Anslutning misslyckades: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    // Här är det en if- och en else-statement med while loop vilket här bygger den en tabell som inkluderar en produkt man har
    // lagt till. Om produkten lyckas läggas till så kommer det visas i en tabell men om den inte lyckas så kommer ingen tabell
    // visas alls.
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
            </a></td>"; // Här lägger den till en delete-knapp med iconen trashcan för varje produkt som läggs i tabellen.
            // Knappen är länkad till en annan php-fil som har inbyggda funktionerna för att kunna ta bort en produkten. Mer 
            // förklaring finns i delete_product-filen
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Inga produkter hittades.";
    }

    $conn->close();
?>

<!-- Visa produkt delen slutar här------------------------------------------------------------------------------------------->


</body>
</html>

