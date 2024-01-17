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
        }

        th {
            background-color: #f2f2f2;
        }

</style>
</head>
<body>
<!-- Here is the link to my phpmyadmin:
http://localhost/phpmyadmin/index.php?route=/table/structure&db=crud_app&table=products -->

    <h1>CRUD App Meny</h1>
    <nav>
       <form action="./funktioner/add_product.php"><button type="submit">Lägg till produkt</button></form>
       <form action="./funktioner/view_products.php"><button type="submit">Se alla produkter</button></form>
       <form action="./funktioner/edit_product.php"><button type="submit">Ändra pris/bild på produkt</button></form>
    </nav>

</body>
</html>

 <!-- Create a database by following these steps:
    1. Search in the browser itself "localhost/phpmyadmin".
    2. Click on one of the links/buttons in the page itself called "Browse".
    3. On the far left you see a net of different objects.
    4. In one of the grids, click on the one called "New", where you create a new database.
    5. When you are in there, it says database name, which is where you name the database so that you can later link its
     name with your php files with codes in them that reference the name of the database.
    6.After the name is named, click on create.
    7. After this, you should create a table where it first wants you to enter the table name and then the number of columns.
    8. In this case I named my table product and since it should include id, name, description, price and image so
    do i need to write 5 columns in this case. After that click create.
    9. After this, you get a structure of a table that needs to be partly filled out.
    10. Where it says name, it must be filled in with id, name, description, price and image.
    11. In the first line where you mentioned id there is a heading called A I Comments which in the first line you should
    write your primary key and then there is a small checkbox to the left of your written primary key to be marked.
    12. Then at the bottom, click save.
    -->
