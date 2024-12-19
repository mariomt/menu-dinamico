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
            flex-direction: column;
            align-items: center; 
            justify-content: center;
        }

        .btn {
            text-decoration: none;
            display: block;
            color: black;
            padding: 10px 15px;
            border: 1px solid;
            margin: 10px;
        }

        .notfound {
            padding: 15px;
            border: 1px solid;
            border-color: rgba(155, 155, 155, 0.8);
            box-shadow: 6px 5px 10px -5px;
        }

        .buttons-container {
            display: flex;
            margin-top: 15px;
        }

        .btn-primary:hover {
            background-color:rgba(65, 139, 202, 0.8);
        }
        h3 {
            text-align: center;
            margin-bottom: 10px;
        }
        h1 {
            text-align: center;
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
        <div class="notfound">
            <h1>Error 500</h1>
            <h3><?= isset($message) ? $message : "Ocurrió un error interno, intentalo de nuevo más tarde."; ?></h3>
        </div>
        <div class="buttons-container">
            <a href="<?= getURL('/menu'); ?>" class="btn btn-primary">Menú</a>
            <a href="<?= getURL('/Menus'); ?>" class="btn btn-secondary">Operaciones</a>
        </div>
    </div>
</body>
</html>