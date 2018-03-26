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
            <button id="s_id" type="submit">Check Stock</button>
        </div>
        <div class="container" align="center" style="margin-top: 20px;">
            <input type="number" placeholder="Customer ID">
            <button id="c_num" type="submit">Check Patient History</button>
        </div>
    </form>
<?php
$conn = oci_connect("ora_q5c1b", "a51931153", "dbhost.ugrad.cs.ubc.ca:1522/ug");
if (!$conn) {
    $m = oci_error();
    echo $m['message'], "\n";
    exit;
}
else {
    $p_num = $_GET('p_num');
    //TODO: Get the information of such prescription
    if($p_num != null) getPrescriptionInfo($p_num, $conn);
    $d_name = $_GET('d_name');
    if ($s_id != null)
    //TODO: Get the information of such drug
    $s_id = $_GET('s_id');
    //TODO: Get the information of such stock
    $c_num = $_GET('c_num');
    //TODO: Get the information of such customer
}

function getPrescriptionInfo($p_num, $conn){
    $p_info = "select * from Prescriotion where 'prescription number' = $p_num ";
    $ociQuery = oci_parse($conn, $p_info);
    oci_execute($ociQuery);
    if($p_info != null) {
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

}


?>
</body>

</html>