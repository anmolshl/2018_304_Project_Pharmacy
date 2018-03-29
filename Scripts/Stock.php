<!DOCTYPE html>
<html lang="en" style="background-color: beige">
<head>
    <meta charset="UTF-8">
    <title>PharmTech - Login</title>
</head>
<body>
<form action="Pharmacist.php" method="post">
    <div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
        <b style="font-family: 'American Typewriter'; font-size: 30px">
            <a href="SQLConnect.php" style="text-decoration: none; color: #000000;">
                PharmTech
            </a>
        </b>
    </div>
    <div class="container" align="center">
        <input id="username" type="text" name="stock_ID" placeholder="Put in stock ID" required>
        <BUTTON type="button" placeholder="Restock">Check stock information</BUTTON>
    </div>
    <div class="container" align="center">
        <input type="text" name="drug_name" placeholder="Drug Name">
        <input type="text" name="drug_add" placeholder="Added Amount">
        <input type="number" name="stock_ID">
        <BUTTON type="button" placeholder="Restock">Restock</BUTTON>
    </div>
    <div class="container" align="center">
        <input type="text" name="drug_name" placeholder="Drug Name">
        <input type="text" name="drug_add" placeholder="Added Amount">
        <BUTTON type="button" placeholder="Restock">Submit</BUTTON>
    </div>
</form>
<?php
//print this information of this stock
oraConnect();
if (isset($_POST['stock_ID'])) {
    $s_id = $_POST['stock_ID'];
    $query = "select * from Stock where stock_ID = '".$s_id."'";
    selectQuery($query, $conn);
}
if (isset($_POST['restock']))
{
    $query = "insert into stock_stores_drugs VALUES ('".$_POST['drug_add']."','".$_POST['drug_name']."','".$_POST['stock_ID']."')";
    insertQuery($query, $conn);
}
?>
</body>
</html>


