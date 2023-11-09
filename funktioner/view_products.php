<!DOCTYPE html>
<html lang="en">
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
    <!-- <form action="delete_product.php"><button type="submit">Ta bort produkt</button></form> -->
</nav>

<?php
// Här kopplar det upp mot databasen som jag skapade enligt instruktionerna som jag skrev i indexen.
// Dessa variabler är definierade för att kunna ansluta till en databas (MySql-databas) då det är servernamnen, användarnamn,
// lösenord och databasnamn ($dbname).    $servername = "localhost";
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
        </a></td>"; // Lägg till Delete-knapp med länk till delete_product.php
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Inga produkter hittades.";
}

$conn->close();
?>
</body>
</html>
