<html lang="en" style="background-color: beige">
<?php
$userName = $_GET['userName'];
$custNo = $_GET['custNo'];
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
    echo "<a href=\"RegDisp.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>\" style=\"text-decoration: none; color: #000000;\">PharmTech</a>";
    echo "</b>";
    echo "</div>";
    echo "<div class=\"container\" align=\"center\">";
    echo "<form action='SearchPagePathogens.php?' method='get'>\n";
    echo "<input id='pathogen_key' type='text' name='pathogen_key' placeholder='Enter Pathogen name' style=\"width: 200px\">\n";
    echo "<input type='hidden' name='userName' value='".htmlentities($userName,ENT_QUOTES)."'>\n";
    echo "<input type='hidden' name='custNo' value='".htmlentities($custNo,ENT_QUOTES)."'>\n";
    echo "<input type=\"submit\" name=\"submit\" style=\"width: 70px; margin-right: 10px\">\n";
    echo "</form>";
    echo "<form action='SearchPagePathogens.php?' method='get'>\n";
    echo "<input id='illness_key' type='text' name='illness_key' placeholder='Enter Illness name' style=\"width: 200px\">\n";
    echo "<input type='hidden' name='userName' value='".htmlentities($userName,ENT_QUOTES)."'>\n";
    echo "<input type='hidden' name='custNo' value='".htmlentities($custNo,ENT_QUOTES)."'>\n";
    echo "<input type=\"submit\" name=\"submit\" style=\"width: 70px; margin-right: 10px\">\n";
    echo "</form>";
    echo "<form action='SearchPagePathogens.php?' method='get'>\n";
    echo "<input id='symptom_key' type='text' name='symptom_key' placeholder='Enter Symptom name' style=\"width: 200px\">\n";
    echo "<input type='hidden' name='userName' value='".htmlentities($userName,ENT_QUOTES)."'>\n";
    echo "<input type='hidden' name='custNo' value='".htmlentities($custNo,ENT_QUOTES)."'>\n";
    echo "<input type=\"submit\" name=\"submit\" style=\"width: 70px; margin-right: 10px\">\n";
    echo "</form>";
    echo "<form action='SearchPagePathogens.php?' method='get'><div style='margin: 0;padding: 0'>\n";
    echo "<div>";
    //echo "<label for='min'>Min Price</label>";
    //echo "<input id='min_key' type='text' name='min_key'  placeholder='Min Price' style=\"width: 100px\">\n";
    echo "<select name=\"Queries\"  style=\"width: 100px\">\n";
    echo "<option value=\"1\">Pathogen Treatment Costs</option>\n";
    echo "<option value=\"2\">Symptom Treatability </option>\n";
    echo "</select>\n";
    echo "<select name=\"MinMax\"  style=\"width: 100px\">\n";
    echo "<option value=\"Min\">Min</option>\n";
    echo "<option value=\"Max\">Max</option>\n";
    echo "</select>\n";
    //echo "<input id='max_key' type='text' name='max_key'  placeholder='Max Price' style=\"width: 100px\">\n";
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
    if (isset($_GET['pathogen_key'])) {
        $WordSearch = $_GET['pathogen_key'];
        $drugRetr = "SELECT illness_name, pathogen, duration FROM Illness WHERE pathogen='" . $WordSearch . "'";
        $ociQuery = oci_parse($conn, $drugRetr);
        selectQuery($conn, $ociQuery);
        if ($WordSearch != null) {
            echo "<table border='1' align='center'>\n";
            echo "<tr>\n";
            echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Illness</td>\n";
            echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Pathogen</td>\n";
            echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Duration (Days)</td>\n";
            echo "</tr>\n";
        }
        while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo "<tr>\n";
            $item0 = null;
            $validRow = 0;
            $rowArr = array();
            foreach ($row as $item) {
                $validRow = 1;
                $item0 = $item;
                echo "    <td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                array_push($rowArr, $item);
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    } else if (isset($_GET['illness_key'])) {
        $WordSearch = $_GET['illness_key'];
        $drugRetr = "SELECT illness_name, pathogen, duration FROM Illness WHERE illness_name='" . $WordSearch . "'";
        $ociQuery = oci_parse($conn, $drugRetr);
        selectQuery($conn, $ociQuery);
        if ($WordSearch != null) {
            echo "<table border='1' align='center'>\n";
            echo "<tr>\n";
            echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Illness</td>\n";
            echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Pathogen</td>\n";
            echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Duration (Days)</td>\n";
            echo "</tr>\n";
        }
        while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo "<tr>\n";
            $item0 = null;
            $validRow = 0;
            $rowArr = array();
            foreach ($row as $item) {
                $validRow = 1;
                $item0 = $item;
                echo "    <td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                array_push($rowArr, $item);
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    } else if (isset($_GET['symptom_key'])) {
        $WordSearch = $_GET['symptom_key'];
        $drugRetr = "SELECT Symptom.symptom, description
        FROM Symptom
        WHERE Symptom.symptom ='" . $WordSearch . "'";
        $ociQuery = oci_parse($conn, $drugRetr);
        selectQuery($conn, $ociQuery);
        if ($WordSearch != null) {
            echo "<table border='1' align='center'>\n";
            echo "<tr>\n";
            echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Symptom</td>\n";
            echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Description</td>\n";
            echo "</tr>\n";
        }
        while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo "<tr>\n";
            $item0 = null;
            $validRow = 0;
            $rowArr = array();
            foreach ($row as $item) {
                $validRow = 1;
                $item0 = $item;
                echo "    <td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                array_push($rowArr, $item);
            }
            echo "</tr>\n";
        }
        echo "</table>\n";
    } else if (isset($_GET['Queries'])){
        $WordSearch = $_GET['Queries'];
        $aggregate = $_GET['MinMax'];

        switch ($WordSearch){
            case 1:
                $drugRetr = "with Gavg as (select Round(avg(price), 2) as avgprice, Illness.pathogen as patho from Drugs, Illness 
                where Drugs.illness_name = Illness.illness_name group by Illness.pathogen) select Gavg.avgprice, Gavg.patho 
                from Gavg where Gavg.avgprice = (select ". $aggregate ."(Gavg.avgprice) from Gavg)";
                $ociQuery = oci_parse($conn, $drugRetr);
                selectQuery($conn, $ociQuery);
                if ($WordSearch != null) {
                    echo "<table border='1' align='center'>\n";
                    echo "<tr>\n";
                    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Average Medication Cost</td>\n";
                    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Pathogen</td>\n";
                    echo "</tr>\n";
                }
                while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    echo "<tr>\n";
                    $item0 = null;
                    $validRow = 0;
                    $rowArr = array();
                    foreach ($row as $item) {
                        $validRow = 1;
                        $item0 = $item;
                        echo "    <td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                        array_push($rowArr, $item);
                    }
                    echo "</tr>\n";
                }
                echo "</table>\n";

                $drugRetr = "select Round(avg(price), 2) as avgprice, Illness.pathogen as patho from Drugs, Illness 
                where Drugs.illness_name = Illness.illness_name group by Illness.pathogen order by avgprice desc";
                $ociQuery = oci_parse($conn, $drugRetr);
                selectQuery($conn, $ociQuery);
                if ($WordSearch != null) {
                    echo "<table border='1' align='center'>\n";
                    echo "<tr>\n";
                    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Average Medication Cost</td>\n";
                    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Pathogen</td>\n";
                    echo "</tr>\n";
                }
                while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    echo "<tr>\n";
                    $item0 = null;
                    $validRow = 0;
                    $rowArr = array();
                    foreach ($row as $item) {
                        $validRow = 1;
                        $item0 = $item;
                        echo "    <td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                        array_push($rowArr, $item);
                    }
                    echo "</tr>\n";
                }
                echo "</table>\n";
                break;

            case 2:
                $drugRetr = "with compact as (
SELECT Symptom.symptom, listagg(Illness_has_symptom.illness_name, ',') 
WITHIN GROUP (ORDER BY Illness_has_symptom.illness_name) as Illnesses
FROM Symptom, Illness_has_symptom
        WHERE Symptom.symptom=Illness_has_symptom.symptom
        GROUP BY Symptom.symptom
),
counts as (
select count(drug_name) as num,
	Illness.pathogen as patho
	from Drugs, Illness_has_symptom, Illness
	where Drugs.illness_name = Illness_has_symptom.illness_name 
	and Illness.illness_name = Drugs.illness_name
	group by Illness.pathogen
),
agg as (
select sum(counts.num) as sympamount,
	Illness_has_symptom.symptom as symptom
	from counts, Illness, Illness_has_symptom
	where counts.patho = Illness.pathogen 
	and Illness.illness_name = Illness_has_symptom.illness_name
	group by Illness_has_symptom.symptom
)
select compact.Symptom, description, compact.Illnesses, agg.sympamount
from compact, Symptom, counts, agg
where compact.Symptom = Symptom.symptom and agg.symptom = Symptom.symptom
and agg.sympamount = (select ". $aggregate."(agg.sympamount) from agg)
group by compact.Symptom, description, compact.Illnesses, agg.sympamount
ORDER by agg.sympamount DESC";
                $ociQuery = oci_parse($conn, $drugRetr);
                selectQuery($conn, $ociQuery);
                if ($WordSearch != null) {
                    echo "<table border='1' align='center'>\n";
                    echo "<tr>\n";
                    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Symptom</td>\n";
                    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Description</td>\n";
                    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Illnesses</td>\n";
                    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Drug Count</td>\n";
                    echo "</tr>\n";
                }
                while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    echo "<tr>\n";
                    $item0 = null;
                    $validRow = 0;
                    $rowArr = array();
                    foreach ($row as $item) {
                        $validRow = 1;
                        $item0 = $item;
                        echo "    <td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                        array_push($rowArr, $item);
                    }
                    echo "</tr>\n";
                }
                echo "</table>\n";

                $drugRetr = "with compact as (
SELECT Symptom.symptom, listagg(Illness_has_symptom.illness_name, ',') 
WITHIN GROUP (ORDER BY Illness_has_symptom.illness_name) as Illnesses
FROM Symptom, Illness_has_symptom
        WHERE Symptom.symptom=Illness_has_symptom.symptom
        GROUP BY Symptom.symptom
),
counts as (
select count(drug_name) as num,
	Illness.pathogen as patho
	from Drugs, Illness_has_symptom, Illness
	where Drugs.illness_name = Illness_has_symptom.illness_name 
	and Illness.illness_name = Drugs.illness_name
	group by Illness.pathogen
),
agg as (
select sum(counts.num) as sympamount,
	Illness_has_symptom.symptom as symptom
	from counts, Illness, Illness_has_symptom
	where counts.patho = Illness.pathogen 
	and Illness.illness_name = Illness_has_symptom.illness_name
	group by Illness_has_symptom.symptom
)
select compact.Symptom, description, compact.Illnesses, agg.sympamount
from compact, Symptom, counts, agg
where compact.Symptom = Symptom.symptom and agg.symptom = Symptom.symptom
group by compact.Symptom, description, compact.Illnesses, agg.sympamount
ORDER by agg.sympamount DESC";
                $ociQuery = oci_parse($conn, $drugRetr);
                selectQuery($conn, $ociQuery);
                if ($WordSearch != null) {
                    echo "<table border='1' align='center'>\n";
                    echo "<tr>\n";
                    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Symptom</td>\n";
                    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Description</td>\n";
                    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Illnesses</td>\n";
                    echo "<td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">Drug Count</td>\n";
                    echo "</tr>\n";
                }
                while ($row = oci_fetch_array($ociQuery, OCI_ASSOC + OCI_RETURN_NULLS)) {
                    echo "<tr>\n";
                    $item0 = null;
                    $validRow = 0;
                    $rowArr = array();
                    foreach ($row as $item) {
                        $validRow = 1;
                        $item0 = $item;
                        echo "    <td style=\"text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';\">" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                        array_push($rowArr, $item);
                    }
                    echo "</tr>\n";
                }
                echo "</table>\n";

        }

    }
    oci_close($conn);
}
?>
</html>








