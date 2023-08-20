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
                    <tr class="thead">
                        <th>CÓDIGO</th>
                        <th>DESCRIÇÃO</th>
                        <th>VALIDADE</th>
                        <th>FUNÇÕES</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td data-title="CÓDIGO">AXC3-A23D</td>
                        <td data-title="DESCRIÇÃO">Lorem ipsum dolor sit amet consribus odit quia fugit ea rerum! Amet fugiat dolores doloribus? lor</td>
                        <td data-title="VALIDADE">20/08/2023 - 00:23</td>
                        <td data-title="FUNÇÕES">
                            <button class="edit-button">Editar</button>
                            <button class="remove-button">Remover</button>
                        </td>
                    </tr>
                </tbody>
                
                <tfoot>
                    <tr>
                        <td><input placeholder="Código..." type="text"></td>
                        <td><input placeholder="Descrição..." type="text"></td>
                        <td><input placeholder="Validade..." type="text"></td>
                        <td>
                            <button class="save-code-button">Salvar</button>
                        </td>
                    </tr>
                </tfoot>

            </table>
        </div>
    </main>
    <script language="JavaScript" src="../shared/js/navbar.js"></script>
</body>
</html>