<?php

namespace GbClicker\Controller;
use GbClicker\Service\PurchaseService;

class SavePurchaseController
{
    public function index()
    {
        if (!self::verificarSessao()) {
            self::jsonResponse([
                'resposta' => PurchaseService::ERRO_AO_INICIAR_SESSAO,
                'mensagem' => 'Sessao invalida.',
            ]);
            return;
        }

        $payload = self::verificarConteudoJson();
        if ($payload === null) {
            self::jsonResponse([
                'resposta' => PurchaseService::ERRO_AO_SALVAR_COMPRA,
                'mensagem' => 'Payload invalido.',
            ]);
            return false;
        }

        $itemId = (int) ($payload['id-item'] ?? 0);
        $quantidade = (int) ($payload['input-quantidade'] ?? 0);

        $service = new PurchaseService();
        $resultado = $service->purchase($_SESSION['email'], $itemId, $quantidade);
        self::jsonResponse($resultado);
        return true;
    }

    public function verificarConteudoJson()
    {
        $contentType = $_SERVER['CONTENT_TYPE'] ?? '';
        $contentIsJson = stripos($contentType, 'application/json') === 0;

        if ($contentIsJson) {

            $dadosRecebidos = file_get_contents("php://input");
            $dadosDecodificados = json_decode($dadosRecebidos, true);

            if (!is_array($dadosDecodificados)) {
                return null;
            }

            return $dadosDecodificados;
        }

        return null;
    }

    private static function verificarSessao(): bool
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {

        }

        return isset($_SESSION['email']);
    }

    private static function jsonResponse(array $payload): void
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($payload);
        exit();
    }
}
