<!DOCTYPE html>
<html lang="en" style="background-color: beige">
<head>
    <meta charset="UTF-8">
    <title>Pharmtech - Prescription</title>
</head>
<body>
    <form action="Prescription.php", method="get">
        <div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
            <b style="font-family: 'American Typewriter'; font-size: 30px">
                <a href="SQLConnect.php" style="text-decoration: none; color: #000000;">
                    PharmTech
                </a>
            </b>
        </div>
        <div class="container" align="center" style="margin-top: 20px;">
            <button type="submit">Write Prescription</button>
        </div>
    </form>
    <form action="Pharmacist.php", method="post">
        <div class="container" align="center" style="margin-top: 20px;">
            <input name="p_num" type="number" placeholder="Prescription Number">
            <button  type="submit">Read Prescription</button>
        </div>
        <div class="container" align="center" style="margin-top: 20px;">
            <input name="d_name" type="text" placeholder="Drug Name">
            <button  type="submit">Search Drug</button>
        </div>
        <div class="container" align="center" style="margin-top: 20px;">
            <input name="s_id" type="number" placeholder="Stock ID">
            <button  type="submit">Check Stock Information</button>
        </div>
        <div class="container" align="center" style="margin-top: 20px;">
            <input name="c_num" type="number" placeholder="Customer ID">
            <button type="submit">Check Patient Information</button>
        </div>
    </form>
<?php
require "SQLQuery.php";
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    echo 'connect successfully';
    if(isset($_SESSION['p_num'])){
        echo 'You added '. $_SESSION['p_num'];
    }
    //print the information of this prescription
    if (isset($_POST['p_num'])) {
        $p_num = $_POST['p_num'];
        $p_info = "select * from Prescriotion where prescription_number = '".$p_num."' ";
        getInfo($p_info, $conn);
    }
    //print the information of this drug
    if (isset($_POST['d_name'])) {
        echo '<br>';
        echo 'get Drug info';
        echo '<br>';
        $d_name = $_POST['d_name'];
        $d_info = "select * from Drugs where drug_name = '".$d_name."'";
        getInfo($d_info, $conn);
    }
    //print this information of this stock
    if (isset($_POST['s_id'])) {
        $s_id = $_POST['s_id'];
        $s_info = "select * from Stock where stock_ID = $s_id";
        getInfo($s_info, $conn);
    }
    //print the information of this customer
    if (isset($_POST['c_num'])) {
        $c_num = $_POST['c_num'];
        $c_info = "select * from Customer where customer_number = $c_num";
        getInfo($c_info, $conn);
    }
}
function getInfo($info, $conn){
    $ociQuery = oci_parse($conn, $info);
    selectQuery($conn, $ociQuery);
    while ($row = oci_fetch_array($ociQuery, OCI_ASSOC+OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>\n";
}


?>
</body>

</html>