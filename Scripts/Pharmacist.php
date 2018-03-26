<?php session_start();
?>
/**
 * Created by PhpStorm.
 * User: lilinjian
 * Date: 25/03/2018
 * Time: 16:41
 */
/**
 * Created by PhpStorm.
 * User: lilinjian
 * Date: 25/03/2018
 * Time: 15:18
 */
<!DOCTYPE html>
<html lang="en" style="background-color: beige">
<head>
    <meta charset="UTF-8">
    <title>Pharmtech - Pharmacist</title>
</head>
<body>
<form action="Prescription.php">
    <div class="container" align="center" style="margin-top: 20px;">
        <button type="submit">Write Prescription</button>
    </div>
</form>
<?php

$p_num = $_SESSION['p_num'];
if ($p_num != 0){
    echo $p_num;
}
echo "bitch";
?>
</body>

</html>