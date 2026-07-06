<?php

namespace GbClicker\Controller\Admin;

use GbClicker\DAO\UserDAO;
use GbClicker\Model\UserModel;
use GbClicker\Service\UserService;
use GbClicker\Controller\Admin\AdminPageController;
use GbClicker\Http\Request;

class AccountsController
{

    private AdminPageController $adminPageController;
    private Request $request;
    private UserService $userService;

    public function __construct(AdminPageController $adminPageController, Request $request, UserService $userService)
    {
        $this->adminPageController = $adminPageController;
        $this->request = $request;
        $this->userService = $userService;
    }
    public function index()
    {
        $model = $this->adminPageController->verifyAdminAccount();
        $contas = [];
        $titulo = 'ADM | Accounts';
        $linksCss = [
            'css/adminpages.css',
            'css/accounts.css'
        ];
        $srcJs = [
            'js/Accounts/accounts.js'
        ];
        $conteudoMain = '..\\View\\admin\\accounts.php';
        require_once '..\\src\\Components\\template.php';
    }

    public function showUsers()
    {
        $page = $this->request->get('page') ?? 1;
        $search = $this->request->get('search') ?? '';
        
        $contas = $this->userService->listPaginated((int)$page, $search);
        
        echo "<div id='linhas_dados_usuarios'>";
        foreach ($contas as $conta) {
            echo $this->montarLinhas($conta);
        }
        echo "</div>";
    }

    public function showPagination()
    {
        $search = $this->request->get('search') ?? '';
        $total = $this->userService->countAccounts($search);
        
        $totalPages = ceil($total / 10);
        $currentPage = (int)($this->request->get('page') ?? 1);
        
        $searchQuery = !empty($search) ? '&search=' . urlencode($search) : '';

        echo "<section class='seletor-paginas'>";
        if ($totalPages <= 1) {
            echo "<a href='/admin/accounts?page=1{$searchQuery}' class='active'>1</a>";
        } else {
            for ($i = 1; $i <= $totalPages; $i++) {
                $activeClass = ($i === $currentPage) ? "class='active'" : "";
                echo "<a href='/admin/accounts?page={$i}{$searchQuery}' {$activeClass}>{$i}</a>";
            }
        }
        echo "</section>";
    }

    public function montarLinhas($conta)
    {
        $nickname = htmlspecialchars((string)$conta->getNickname(), ENT_QUOTES, 'UTF-8');
        $imageSrc = htmlspecialchars((string)$conta->getImageSrc(), ENT_QUOTES, 'UTF-8');
        $money = htmlspecialchars((string)$conta->getMoney(), ENT_QUOTES, 'UTF-8');

        $informacoes_e_tipo_input_array = array(
            [$nickname, "text", "nickname"],
            [$imageSrc, "image", "imagesrc"],
            [$money, "number", "money"],
        );

        $id = htmlspecialchars((string)$conta->getId(), ENT_QUOTES, 'UTF-8');
        $email = htmlspecialchars((string)$conta->getEmail(), ENT_QUOTES, 'UTF-8');

        $comecoLinha = "
        <form id='id_" . $id . "' class='linha' method='POST' action='./accounts/save'>
            <p class='p_user_info'>" . $id . "</p>
            <p class='p_user_info' title='" . $email . "'>" . $email . "</p>
        ";

        $meioLinha = "";
        foreach($informacoes_e_tipo_input_array as $infos) {
            if ($infos[1] === "image") {
                $meioLinha .= "
                    <img src='../" . $infos[0] . "'>
                ";
                continue;
            }
            $meioLinha .= "
                <p class='p_user_info info_editaveis' title='" . $infos[0] . "'> " . $infos[0] . "</p>
                <input name='" . $infos[2] . "_input_" . $conta->getId() . "' style='display:none' class='inputs_edicao' type=" . $infos[1] . " value='" . $infos[0] . "'>
            ";
        }

        $fimLinha = "
            <div class='acoes-container'>
                <a onclick='edicao(" . $id . ")' class='botao-acoes blue'>Editar</a>
                <a id='botao-remover' onclick='removerConta(" . $id . ")' class='botao-acoes red'>Remover</a>
                <a onclick='salvarEdicao(" . $id . ")' id='botao-salvar' style='display:none' class='botao-acoes green'>Salvar</a>
            </div>
        </form>
    ";

        return $comecoLinha . $meioLinha . $fimLinha;
    } 
}
