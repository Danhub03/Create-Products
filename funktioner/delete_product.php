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
        }

        table img {
            width: 70%;
            height: 20vh
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 2px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

</style>
</head>
<body>

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


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id = $id";

    // Here the sql query is executed then if the query succeeds the code of the if statement will be executed otherwise if it fails it will print an error-
    // message.
    if ($conn->query($sql) === TRUE) {
         header("Location: add_product.php"); // Here it redirects the browser back to the add_product.php page after that
        // the product has been removed.
         exit(); // Here it ends the PHP code which causes the web page to end.
    } else {
        echo "Fel: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

</body>
</html>
