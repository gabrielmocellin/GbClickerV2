<?php

namespace GbClicker\Controller\Shop\Actions;

use GbClicker\Service\PurchaseService;
use GbClicker\Http\Request;
use GbClicker\Http\Session;

class SavePurchaseController
{
    private PurchaseService $purchaseService;
    private Request $request;
    private Session $session;

    public function __construct(PurchaseService $purchaseService, Request $request, Session $session)
    {
        $this->purchaseService = $purchaseService;
        $this->request = $request;
        $this->session = $session;
    }

    public function index()
    {
        if (!$this->verificarSessao()) {
            $this->jsonResponse([
                'resposta' => PurchaseService::ERRO_AO_INICIAR_SESSAO,
                'mensagem' => 'Sessao invalida.',
            ]);
            return;
        }

        $payload = $this->verificarConteudoJson();
        if ($payload === null) {
            $this->jsonResponse([
                'resposta' => PurchaseService::ERRO_AO_SALVAR_COMPRA,
                'mensagem' => 'Payload invalido.',
            ]);
            return;
        }

        $itemId = (int) ($payload['id-item'] ?? 0);
        $quantidade = (int) ($payload['input-quantidade'] ?? 0);

        $resultado = $this->purchaseService->purchase($this->session->get('email'), $itemId, $quantidade);
        $this->jsonResponse($resultado);
    }

    public function verificarConteudoJson()
    {
        // Ideally Request class should provide headers, but we read php://input here for raw JSON body
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

    private function verificarSessao(): bool
    {
        return $this->session->has('email');
    }

    private function jsonResponse(array $payload): void
    {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($payload);
        exit();
    }
}
