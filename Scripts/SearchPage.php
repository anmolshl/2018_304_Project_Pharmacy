<html lang="en" style="background-color: beige">
<?php
$userName = $_GET['userName'];
$custNo = $_GET['custNo'];
$cartArr = $_GET['cartArr'];
?>
<head>
    <meta charset="UTF-8">
    <title>Welcome Guest!</title>
</head>
<body>
    <?php
    if(!(empty($userName) && empty($custNo))){
        echo "<div align=\"center\" style=\"margin-bottom: 40px; margin-top: 20px; background-color: red\">";
        echo "<b style=\"font-family: 'American Typewriter'; font-size: 30px\">";
        echo "<a href=\"RegDisp.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>&cartArr=<?php if(!empty($cartArr)){echo $cartArr;} ?>\" style=\"text-decoration: none; color: #000000;\">PharmTech</a>";
        echo "</b>";
        echo "</div>";
        echo "<div class=\"container\" align=\"center\">";
        echo "<form action='SearchPage.php?' method='get'>\n";
        echo "<input id='search_key' type='text' name='search_key' placeholder='Enter drug name' style=\"width: 200px\">\n";
        echo "<input type='hidden' name='userName' value='".htmlentities($userName,ENT_QUOTES)."'>\n";
        echo "<input type='hidden' name='custNo' value='".htmlentities($custNo,ENT_QUOTES)."'>\n";
        echo "<input type=\"submit\" name=\"submit\" style=\"width: 70px; margin-right: 10px\">\n";
        echo "</form>";
        echo "<div class=\"container\" align=\"center\" style=\"margin-top: 20px;\">";
        echo "<a href=\"../Interfaces/LoginPage.html\" style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Logout</a>";
        echo "</div>\n";
    }
    else{
        echo "<div align=\"center\" style=\"margin-bottom: 40px; margin-top: 20px; background-color: red\">";
        echo "<b style=\"font-family: 'American Typewriter'; font-size: 30px\">";
        echo "<a href=\"SQLConnect.php\" style=\"text-decoration: none; color: #000000;\">PharmTech</a>";
        echo "</b>";
        echo "</div>";
        echo "<div class=\"container\" align=\"center\">";
        echo "<form action='SearchPage.php?' method='get'>\n";
        echo "<input id='search_key' type='text' name='search_key' placeholder='Enter drug name' style=\"width: 200px\">\n";
        echo "<input type=\"submit\" name=\"submit\" style=\"width: 70px; margin-right: 10px\">\n";
        echo "</form>";
    }
    ?>
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
        echo "<table border='1' align='center'>\n";
        echo "<tr>\n";
        echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Drug Name</td>\n";
        echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Drug Type</td>\n";
        echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Illness</td>\n";
        echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Price</td>\n";
        echo "</tr>\n";
    }
    while ($row = oci_fetch_array($ociQuery, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        $item0 = null;
        $validRow = 0;
        $rowArr = array();
        foreach($row as $item) {
            $validRow = 1;
            $item0 = $item;
            echo "    <td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
            array_push($rowArr, $item);
        }
        if($validRow == 1) {
            echo "<td>";
            echo "<a href='OnAddToCart.php?action&drugName=" . $rowArr[0] . "&drugType=" . $rowArr[1] . "&price=" . (string)$rowArr[3] . "&cartArr=" . $cartArr . "&userName=" .$userName."&custNo=". $custNo ."' style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">ADD</a>";
            echo "</td>";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
    oci_close($conn);
}
?>
</html>








