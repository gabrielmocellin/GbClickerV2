<?php

namespace GbClicker\Model;

use GbClicker\DAO\ItemDao;

class ItemModel
{
    public $id;
    public $nome;
    public $descricao;
    public $preco;
    public $minimum_level;
    public $quantidade;
    public $image_src;
    public $tipo;
    
    public function construtor($nm, $desc, $pr, $min, $qt, $im, $tp)
    {
        $this->setNome($nm);
        $this->setDescricao($desc);
        $this->setPreco($pr);
        $this->setMinimumLevel($min);
        $this->setQuantidade($qt);
        $this->setImageSrc($im);
        $this->setTipo($tp);
    }

    public function save()
    {
        $dao = new ItemDAO();
        if ($dao->insert($this)) {
            return true;
        }
        return false;
    }

    public function getById($id)
    {
        $itemDao = new ItemDAO();
        $itemInfo = $itemDao->selectById($id);
        $this->fillItemModel($itemInfo);
    }

    public function getAllItems()
    {
        $itemDao = new ItemDAO();
        return $itemDao->select();
    }

    public function getAllTypes()
    {
        $itemDao = new ItemDao();
        return $itemDao->selectAllItemTypes();
    }

    public function fillItemModel($data)
    {
        $this->setId($data['id']);
        $this->setImageSrc($data['image_src']);
        $this->setPreco($data['preco']);
        $this->setDescricao($data['descricao']);
        $this->setQuantidade($data['quantidade']);
        $this->setMinimumLevel($data['minimum_level']);
        $this->setTipo($data['FK_id_tipos_itens']);
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

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function getImageSrc()
    {
        return $this->image_src;
    }

    public function getTipo()
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

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;
    }

    public function setImageSrc($image_src)
    {
        $this->image_src = $image_src;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }
}
