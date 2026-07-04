<?php

namespace GbClicker\Controller\Admin\Actions;

use GbClicker\Http\Request;
use GbClicker\Http\Session;
use GbClicker\Model\UserModel;
use GbClicker\Controller\Admin\AdminPageController;
use GbClicker\Conexao\Conexao;

class DeleteAccountController
{
    private Request $request;
    private Session $session;
    private AdminPageController $adminPageController;

    public function __construct(Request $request, Session $session, AdminPageController $adminPageController)
    {
        $this->request = $request;
        $this->session = $session;
        $this->adminPageController = $adminPageController;
    }

    public function index()
    {
        $admin = $this->adminPageController->verifyAdminAccount();
        if (!$admin) {
            http_response_code(401);
            echo json_encode(["status" => "error", "message" => "Não autorizado"]);
            exit;
        }

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!isset($data['id'])) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID não fornecido"]);
            exit;
        }

        $id = $data['id'];
        
        if ($admin->getId() == $id) {
            echo json_encode(["resposta" => 100, "message" => "Não é possível excluir a própria conta"]);
            exit;
        }

        try {
            $conexao = Conexao::criarConexao();
            // We use direct PDO here as a shortcut since UserDAO deletes by email and it's easier to delete by ID here.
            $sql = "DELETE FROM usuario WHERE id = :id";
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            
            echo json_encode(["resposta" => 0]);
        } catch (\Exception $e) {
            echo json_encode(["resposta" => 100, "message" => "Erro ao deletar conta"]);
        }
    }
}
