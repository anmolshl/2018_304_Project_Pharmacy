<html lang="en" style="background-color: beige">
<?php
$userDetsQuery = $_GET['userDets'];
$userDets = array();
parse_str($userDetsQuery, $userDets);

$userName = $_GET['0'];
$custNo = $_GET['1'];


foreach ($userDets as $x){
    echo $x;
}

if(empty($userName) || empty($custNo)){
    header("Location: ../Interfaces/34_project_final_LoginPage.html");
}

/**
 * Created by PhpStorm.
 * User: anmolsingh
 * Date: 2018-03-13
 * Time: 10:36 AM
 */
require "34_project_final_SQLQuery.php";
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    print "Connected to Oracle!";
}
?>

<head>
    <meta charset="UTF-8">
    <title>PUser Home</title>
</head>
<body>
<div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
    <b style="font-family: 'American Typewriter'; font-size: 30px">
        <a href="34_project_final_RegDisp.php?userDets=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>" style="text-decoration: none; color: #000000;">
            PharmTech
        </a>
    </b>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="34_project_final_SearchPage.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Search and Add to Order
    </a>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="34_project_final_SearchPagePathogens.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Search Pathogens and Symptoms
    </a>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="34_project_final_PrescriptionsRetr.php?userName=<?php echo $userName; ?>&custNo=<?php echo $custNo; ?>" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Prescriptions
    </a>
</div>
<div class="container" align="center" style="margin-top: 20px;">
    <a href="../Interfaces/34_project_final_LoginPage.html" style="text-decoration: none; color: #000000; font-size: 15px; font-family: 'American Typewriter';">
        Logout
    </a>
</div>
</body>
</html>