<html lang="en" style="background-color: beige">
<head>
    <meta charset="UTF-8">
    <title>Welcome Guest!</title>
</head>
<body>
<div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
    <b style="font-family: 'American Typewriter'; font-size: 30px">
        <a href="SQLConnect.php" style="text-decoration: none; color: #000000;">
            PharmTech
        </a>
    </b>
</div>
<div class="container" align="center">
    <form action="UnregCustDatRetr.php" method="get">
        <input id="search_key" type="text" name="search_key" placeholder="Enter drug name" style="width: 200px">
        <input type="submit" name="submit" style="width: 70px; margin-right: 10px">
    </form>
</div>
</body>
<?php
require "SQLQuery.php";

$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    echo "<br>Connected to Oracle!</br>";
    $WordSearch = $_GET['search_key'];
    $drugRetr = "select drug_name, drugType, illness_name, price from Drugs where drug_name='".$WordSearch."'";
    $ociQuery = oci_parse($conn, $drugRetr);
    selectQuery($conn, $ociQuery);
    if($WordSearch != null) {
        echo "<table border='1'>\n";
        echo "<tr>\n";
        echo "<td>Drug Name</td>\n";
        echo "<td>Drug Type</td>\n";
        echo "<td>Illness</td>\n";
        echo "<td>Price</td>\n";
        echo "</tr>\n";
    }
    while ($row = oci_fetch_array($ociQuery, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
    oci_close($conn);
}
?>
</html>








