<?php session_start();
?>
<!DOCTYPE html>
<html lang="en" style="background-color: beige">
<head>
    <meta charset="UTF-8">
    <title>Pharmtech - Prescription</title>
</head>
<body>
    <form action="Prescription.php", method="post">
        <div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
            <b style="font-family: 'American Typewriter'; font-size: 30px">PharmTech</b>
        </div>
        <div class="container" align="center" style="margin-top: 20px;">
            <button type="submit">Write Prescription</button>
        </div>
    </form>
    <form action="Pharmacist.php">
        <div class="container" align="center" style="margin-top: 20px;">
            <input type="number" placeholder="Prescription Number">
            <button id="p_num" type="submit">Read Prescription</button>
        </div>
        <div class="container" align="center" style="margin-top: 20px;">
            <input type="text" placeholder="Drug Name">
            <button id="d_name" type="submit">Search Drug</button>
        </div>
        <div class="container" align="center" style="margin-top: 20px;">
            <input type="number" placeholder="Stock ID">
            <button id="s_id" type="submit">Check Stock Information</button>
        </div>
        <div class="container" align="center" style="margin-top: 20px;">
            <input type="number" placeholder="Customer ID">
            <button id="c_num" type="submit">Check Patient Information</button>
        </div>
    </form>
<?php
/*$conn = oci_connect("ora_q5c1b", "a51931153", "dbhost.ugrad.cs.ubc.ca:1522/ug");
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}
else {*/
    //print the information of this prescription
    if (isset($_GET['p_num'])){
        $p_num = $_GET['p_num'];
        $p_info = "select * from Prescriotion where prescription_number = $p_num " ;
        getInfo($p_info, $conn);
    }
    //print the information of this drug
    if (isset($_GET['d_name'])){
        $d_name = $_GET['d_name'];
        $d_info = "select * from Drugs where drug_name = $d_name";
        getInfo($d_info, $conn);
    }
    //print this information of this stock
    if (isset($_GET['s_id'])){
        $s_id = $_GET['s_id'];
        $s_info = "select * from Stock where stock_ID = $s_id";
        getInfo($s_info, $conn);
    }
    //print the information of this customer
    if (isset($_GET['c_num'])){
        $c_num = $_GET['c_num'];
        $c_info = "select * from Customer where customer_number = $c_num";
        getInfo($c_info, $conn);
    }


function getInfo($info, $conn){
    $ociQuery = oci_parse($conn, $info);
    oci_execute($ociQuery);
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