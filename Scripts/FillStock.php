<html lang="en" style="background-color: beige">

<head>
    <meta charset="UTF-8">
    <title>Pharmtech - Restock</title>
</head>

<body>
<form action="Restock.php?userDets=<?php echo $userDetsQuery; ?>" method="get">
    <div align="center" style="margin-bottom: 40px; margin-top: 20px; background-color: red">
        <b style="font-family: 'American Typewriter'; font-size: 30px">
            <a href="SQLConnect.php" style="text-decoration: none; color: #000000;">
                PharmTech
            </a>
        </b>
    </div>
    <div class="container" align="center">
        <input name="quantity" type="number" min="0" name="quantity" placeholder="Add quantity" required>
    </div>
    <div class="container" align="center">
        <input name="drug_name" type="text" name="drug_name" placeholder="Drug Name" required>
    </div>
    <div class="container" align="center" style="margin-top: 20px;">
        <button type="submit">Submit</button>
    </div>
</form>
</body>