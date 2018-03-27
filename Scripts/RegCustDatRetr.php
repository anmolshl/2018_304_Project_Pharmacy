html lang="en" style="background-color: beige">
<head>
    <meta charset="UTF-8">
    <title>Welcome User!</title>
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
    <form action="RegCustDatRetr.php" method="get">
        <input id="search_key" type="text" name="search_key" placeholder="Enter drug name" style="width: 200px">
        <input type="submit" name="submit" style="width: 70px; margin-right: 10px">
    </form>
</div>
</body>

<?php
$conn = oraConnect();
if (!$conn) {
    exit;
}
else {
    echo "<br>Connected to Oracle!</br>";
    $username = $_GET[$username];
}