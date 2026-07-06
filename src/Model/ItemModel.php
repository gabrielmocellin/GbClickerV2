<?php

namespace GbClicker\Model;



class ItemModel
{
    public $id;
    public $nome;
    public $descricao;
    public $preco;
    public $minimum_level;
    public $efeito_valor;
    public $image_src;
    public $tipo;
    
    public function construtor($nm, $desc, $pr, $min, $ef_val, $im, $tp)
    {
        $this->setNome($nm);
        $this->setDescricao($desc);
        $this->setPreco($pr);
        $this->setMinimumLevel($min);
        $this->setEfeitoValor($ef_val);
        $this->setImageSrc($im);
        $this->setTipo($tp);
    }



    public function fillItemModel($data)
    {
        $this->setId($data['id']);
        $this->setImageSrc($data['image_src']);
        $this->setPreco($data['preco']);
        $this->setDescricao($data['descricao']);
        $this->setEfeitoValor($data['efeito_valor']);
        $this->setMinimumLevel($data['minimum_level']);
        $this->setTipo($data['FK_id_tipos_itens']);
        $this->setEfeito($data['efeito']);
    }

    // =-=-=-=-= GETTERS =-=-=-=-=
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function getMinimumLevel()
    {
        return $this->minimum_level;
    }

    public function getEfeitoValor()
    {
        return $this->efeito_valor;
    }

    public function getImageSrc()
    {
        return $this->image_src;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getEfeito()
    {
        return $this->tipo;
    }

    // =-=-=-=-= SETTERS =-=-=-=-=
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;
    }

    public function setMinimumLevel($minimum_level)
    {
        $this->minimum_level = $minimum_level;
    }

    public function setEfeitoValor($efeito_valor)
    {
        $this->efeito_valor = $efeito_valor;
    }

    public function setImageSrc($image_src)
    {
        $this->image_src = $image_src;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function setEfeito($efeito)
    {
        $this->tipo = $efeito;
    }
}
