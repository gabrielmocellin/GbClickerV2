<?php

namespace GbClicker\Model;

class InventarioModel
{
    public $id;
    public $emailUsuario;
    public $idItem;
    public $quantidade;
    
    // Virtual properties coming from JOINs
    public $itemNome;
    public $efeito;
    public $efeitoValor;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmailUsuario()
    {
        return $this->emailUsuario;
    }

    public function setEmailUsuario($emailUsuario)
    {
        $this->emailUsuario = $emailUsuario;
    }

    public function getIdItem()
    {
        return $this->idItem;
    }

    public function setIdItem($idItem)
    {
        $this->idItem = $idItem;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function getItemNome()
    {
        return $this->itemNome;
    }

    public function setItemNome($itemNome)
    {
        $this->itemNome = $itemNome;
    }

    public function getEfeito()
    {
        return $this->efeito;
    }

    public function setEfeito($efeito)
    {
        $this->efeito = $efeito;
    }

    public function getEfeitoValor()
    {
        return $this->efeitoValor;
    }

    public function setEfeitoValor($efeitoValor)
    {
        $this->efeitoValor = $efeitoValor;
    }
}
