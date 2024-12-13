<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú app</title>
</head>
<body>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 100%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center; 
        }

        .btn {
            text-decoration: none;
            color: black;
            padding: 10px 15px;
            border: 1px solid;
            margin: 10px;
        }

        .btn-primary:hover {
            background-color:rgba(65, 139, 202, 0.8);
        }

        .btn-secondary:hover {
            background-color:rgba(98, 165, 36, 0.8);
        }

        .btn-primary {
            background-color: #418bca;
        }

        .btn-secondary {
            background-color:rgb(98, 165, 36);
        }
    </style>
    <div class="container">
        <a href="/menu" class="btn btn-primary">Menú</a>
        <a href="/Menus" class="btn btn-secondary">Operaciones</a>
    </div>
</body>
</html>