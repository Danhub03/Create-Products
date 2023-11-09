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
            /* margin:auto; */
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
            background-color: #f2f2f2;
        }

</style>
</head>
<body>
<!-- Här länken till min phpmyadmin: 
http://localhost/phpmyadmin/index.php?route=/table/structure&db=crud_app&table=products -->

    <h1>CRUD App Meny</h1>
    <nav>
       <form action="./funktioner/add_product.php"><button type="submit">Lägg till produkt</button></form>
       <form action="./funktioner/view_products.php"><button type="submit">Se alla produkter</button></form>
       <form action="./funktioner/edit_product.php"><button type="submit">Ändra pris/bild på produkt</button></form>
    </nav>

</body>
</html>

 <!-- Skapa en databas genom att följa dessa steg:
    1. Sök i själva browsern "localhost/phpmyadmin".
    2. Klicka på en av länkarna/knapparna i själva sidan som heter "Bläddra".
    3. Längst åt vänster så ser man ett nät av olika objekt.
    4. I ett av näten klicka på det som heter "Ny" vilket där skapar du en ny databas.
    5. När du är där inne står det databasnamn vilken där döper du namnet av databasen så att du kan senare kunna länka dess
     namn med dina php filer med koder i som refererar namnet av databasen.
    6.Efter namnet är döpt klicka på skapa.
    7. Efter detta ska du skapa en tabell där den vill först att du anger tabelnamn och sen antal kolumner.
    8. I detta fall döpte jag min tabel för product och eftersom det ska inkludera id, namn, description, price och image så
    behöver jag skriva 5 kolumner i det här fallet. Efter det klicka på skapa.
    9. Efter detta så får du en struktur av en tabel som behöver dels fyllas på.
    10. Där det står namn ska det fyllas på id, namn, description, price och image.
    11. I första raden där du nämnde id finns det en rubrik som heter A I Kommentarer vilket där i den första raden ska du 
    skriva din primary key och därefter finns det ett litet checkbox åt vänster av din skrivna primary key som ska markeras.
    12. Sen längst ner så klickar du på spara.
    -->
