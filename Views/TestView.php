
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title)? $title : 'test' ?></title>
</head>
<body>
    <h1>Hola <?php echo isset($name)? $name : '' ?>, cómo estas?</h1>
</body>
</html>