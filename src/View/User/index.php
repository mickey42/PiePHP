<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PiePhp</title>
</head>
<body>
    <pre><?php session_star(); echo $_POST['email'] ."\n" .$_SERVER['SERVER_NAME'] . $_GET['email']?></pre>
</body>
</html>