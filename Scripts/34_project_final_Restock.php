<html lang="en" style="background-color: beige">

<head>
    <meta charset="UTF-8">
    <title>Pharmtech - Restock</title>
</head>
<body>
<form action="34_project_final_FillStock.php?userDets=<?php echo $userDetsQuery; ?>" method="get">
    <div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
        <b style="font-family: 'American Typewriter'; font-size: 30px">
            <a href="34_project_final_SQLConnect.php" style="text-decoration: none; color: #000000;">
                PharmTech
            </a>
        </b>
    </div>
<?php
require "34_project_final_SQLQuery.php";
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    $restock = (int)$_GET['quantity'];
    $drug_name = $_GET['drug_name'];
    echo "$restock\n";
    echo "$drug_name\n";

    $retrstockQuery = "SELECT quantity FROM Drugs WHERE drug_name='" . $drug_name . "'";
    $ociQuery = oci_parse($conn, $retrstockQuery);
    selectQuery($conn, $ociQuery);
    while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
        echo "<tr>\n";
        foreach ($row as $item) {
            $fetch = (int)$item + $restock;
        }
    }
    $restockQuery = "UPDATE Drugs SET quantity=" . (string)$fetch . " WHERE drug_name='" . $drug_name ."'";
    $restockParse = oci_parse($conn, $restockQuery);
    insertQuery($conn, $restockParse);
    $restockQuery0 = "commit";
    $restockParse0 = oci_parse($conn, $restockQuery0);
    insertQuery($conn, $restockParse0);
    oci_close($conn);
}
?>
    <div align="center" style="margin-bottom: 40px; margin-top: 20px;">
        <table align="center" border="1">
            <tr>
                <td style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
                    Drug Name
                </td>
                <td style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
                    <?php echo $drug_name; ?>
                </td>
            </tr>
            <tr>
                <td style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
                    Old Quantity
                </td>
                <td style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
                    <?php echo $fetch - $restock; ?>
                </td>
            </tr>
            <tr>
                <td style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
                    New Quantity
                </td>
                <td style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
                    <?php echo $fetch; ?>
                </td>
            </tr>
        </table>
    </div>



