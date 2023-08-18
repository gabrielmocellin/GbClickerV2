<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../shared/style/site.css'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>GbClicker | Admin</title>
</head>
<body>
    <?php 
        require "../shared/header.php";
    ?>
    <main>
        <?php require "../shared/navbar.php"; ?>
        <div id="admin-tickets">
            <table id="create-cupons-table">
                <thead>
                    <tr>
                        <td>CÓDIGO</td>
                        <td>DESCRICAO</td>
                        <td>VALIDO ATÉ</td>
                        <td>GERENCIADOR</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>AXC3-A23D</td>
                        <td>Vida infinita + 30mil em dinheiro</td>
                        <td>20/08/2023 - 00:23</td>
                        <td>
                            <button>Editar</button>
                            <button>Remover</button>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                        <tr>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td><input type="text"></td>
                            <td>
                                <button>Salvar</button>
                            </td>
                        </tr>
                </tfoot>
            </table>
        </div>
    </main>
    <script language="JavaScript" src="../shared/js/navbar.js"></script>
</body>
</html>