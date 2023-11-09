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
}
form legend {
    font-size:25px;
    font-family: arial;
}
form fieldset {
    font-size:15px;
    font-family: arial;
    line-height:20px;
    background-color:whitesmoke;
    padding:10px;

}
.buttonarea {
    margin-bottom:1%

}
table {
            width: 60%;
            border-collapse: collapse;
            overflow: scroll;
            /* margin:auto; */
        }

        table img {
            width: 70%;
            height: 20vh
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 2px solid #ddd;
            /* vertical-align:center; */
        }

        th {
            background-color: #f2f2f2;
        }

</style>
</head>
<body>

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


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = $id";

    // Här körs sql-frågan då om frågan lyckas kommer if-satsens kod att köras annars om det misslyckas skriver det ut ett fel-
    // meddelande.
    if ($conn->query($sql) === TRUE) {
         header("Location: add_product.php"); // Här omdirigerar den webbläsaren tillbaka till sidan add_product.php efter att
        // produkten har blivit borttagen.
         exit(); // Här avslutar den PHP-koden vilket gör att webbsidan avslutas.
    } else {
        echo "Fel: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

</body>
</html>