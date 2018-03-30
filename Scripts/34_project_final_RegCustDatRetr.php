<html lang="en" style="background-color: beige">
<head>
    <meta charset="UTF-8">
    <title>Welcome User!</title>
</head>
<body>
<div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
    <b style="font-family: 'American Typewriter'; font-size: 30px">
        <a href="34_project_final_SQLConnect.php" style="text-decoration: none; color: #000000;">
            PharmTech
        </a>
    </b>
</div>
<div class="container" align="center">
    <form action="34_project_final_RegCustDatRetr.php" method="get">
        <input id="search_key" type="text" name="search_key" placeholder="Enter drug name" style="width: 200px">
        <input type="submit" name="submit" style="width: 70px; margin-right: 10px">
    </form>
    <form action="34_project_final_RegCustDatRetr.php" method="get">
        <input id="diseasecount_key" type="text" name="diseasecount_key" placeholder="Count of DrugType in System" style="width: 200px">
        <input type="submit" name="submit" style="width: 70px; margin-right: 10px">
    </form>
    <form method="get" action="34_project_final_RegCustDatRetr.php">
        <select name="Queries">
            <option value="1">Drug Prices</option>
            <option value="2">Pathogen Treatment Costs</option>
            <option value="3">Pathogen Treatment Options</option>
        </select>
        <input type="submit" value="Submit"/>
    </form>
    <form method="get" action="34_project_final_RegCustDatRetr.php">
        <select name="Criteria">
            <option value="Min">Min</option>
            <option value="Max">Max</option>
        </select>
        <input type="submit" value="Choose"/>
    </form>
    <form action="RegDisp.php">
        <div class="container" align="middle">
            <button type="submit" style="width: 70px;">Go Back</button>
        </div>
        <div class="container" align="bottom">
            <button type="submit" style="width: 70px;">Logout</button>
        </div>
    </form>
</div>

</body>
<?php
require "34_project_final_SQLQuery.php";

$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    $aggregate = "max";
    if (isset($_GET['Criteria'])){
        $aggregate = $_GET['Criteria'];
        echo $aggregate;
        echo "yolo";
    }
    echo $_GET['Criteria']."HII";

    echo "<br>Connected to Oracle!</br>";
    if (isset($_GET['search_key'])) {
        $WordSearch = $_GET['search_key'];
        $drugRetr = "SELECT drug_name, drugType, illness_name, price FROM Drugs WHERE drug_name='" . $WordSearch . "'";
        $ociQuery = oci_parse($conn, $drugRetr);
        selectQuery($conn, $ociQuery);
        if ($WordSearch != null) {
            echo "<table border='1'>\n";
            echo "<tr>\n";
            echo "<td>Drug Name</td>\n";
            echo "<td>Drug Type</td>\n";
            echo "<td>Illness</td>\n";
            echo "<td>Price</td>\n";
            echo "</tr>\n";
        }
        while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo "<tr>\n";
            foreach ($row as $item) {
                echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    } else if (isset($_GET['diseasecount_key'])) {
        $WordSearch = $_GET['diseasecount_key'];
        $drugRetr = "select count(drugType) from Drugs where drugType = '" . $WordSearch . "'";
        $ociQuery = oci_parse($conn, $drugRetr);
        selectQuery($conn, $ociQuery);
        if ($WordSearch != null) {
            echo "<table border='1'>\n";
            echo "<tr>\n";
            echo "<td>Count</td>\n";
            echo "</tr>\n";
        }
        while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo "<tr>\n";
            foreach ($row as $item) {
                echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
            }
            echo "</tr>\n";
        }
        echo "</table>\n";

    } else if (isset($_GET['Queries'])) {
        $WordSearch = $_GET['Queries'];

        switch ($WordSearch){
            case 1:


                $drugRetr = "select drug_name, drugType, illness_name, price from Drugs where price = (select " . $aggregate . "(price) from Drugs)";
                $ociQuery = oci_parse($conn, $drugRetr);
                selectQuery($conn, $ociQuery);
                if ($WordSearch != null) {
                    echo "<table border='1'>\n";
                    echo "<tr>\n";
                    echo "<td>Drug Name</td>\n";
                    echo "<td>Drug Type</td>\n";
                    echo "<td>Illness</td>\n";
                    echo "<td>Price</td>\n";
                    echo "</tr>\n";
                }
                while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    echo "<tr>\n";
                    foreach ($row as $item) {
                        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    }
                    echo "</tr>\n";
                }
                echo "</table>\n";
                echo  $drugRetr;
            break;

            case 2:
                $drugRetr = "with Gavg as (select avg(price) as avgprice, Illness.pathogen as patho from Drugs, Illness 
                where Drugs.illness_name = Illness.illness_name group by Illness.pathogen) select Gavg.avgprice, Gavg.patho 
                from Gavg where Gavg.avgprice = (select max(Gavg.avgprice) from Gavg)";
                $ociQuery = oci_parse($conn, $drugRetr);
                selectQuery($conn, $ociQuery);
                if ($WordSearch != null) {
                    echo "<table border='1'>\n";
                    echo "<tr>\n";
                    echo "<td>Average Price</td>\n";
                    echo "<td>Pathogen</td>\n";
                    echo "</tr>\n";
                }
                while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    echo "<tr>\n";
                    foreach ($row as $item) {
                        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    }
                    echo "</tr>\n";
                }
                echo "</table>\n";
                break;

            case 3:
                $drugRetr = "with counts as (select count(drug_name) as num, Illness.pathogen as patho from Drugs, Illness
	            where Drugs.illness_name = Illness.illness_name group by Illness.pathogen) select counts.num, counts.patho
                from counts where counts.num = (select max(counts.num) from counts)";
                $ociQuery = oci_parse($conn, $drugRetr);
                selectQuery($conn, $ociQuery);
                if ($WordSearch != null) {
                    echo "<table border='1'>\n";
                    echo "<tr>\n";
                    echo "<td>Count</td>\n";
                    echo "<td>Pathogen</td>\n";
                    echo "</tr>\n";
                }
                while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    echo "<tr>\n";
                    foreach ($row as $item) {
                        echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                    }
                    echo "</tr>\n";
                }
                echo "</table>\n";
                break;


        }

    }
    oci_close($conn);
}
?>
</html>