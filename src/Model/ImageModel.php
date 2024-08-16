<?php

namespace GbClicker\Model;

class ImageModel
{
    const IMAGE_TYPE_INVALID = 10;
    public $image;
    public $path;
    public $isEmpty;
    public $isImageSaved;

    function __construct (array $fileSubmitted)
    {
        $this->setImage($fileSubmitted['image_src']);
    }

    
    public function validateImage()
    {
        $image = $this->image;
        $validTypes = ["image/jpeg", "image/jpg", "image/png"];

        $isImageSrcInputEmpty = ($image["tmp_name"] === "" && $image["size"] === 0);
        if ($isImageSrcInputEmpty) {
            $this->setIsEmpty(true);
            return true;
        }

        $isImageTypeValid = in_array($image['type'], $validTypes);
        if ($isImageTypeValid) {
            return true;
        }

        $image['error'] = self::IMAGE_TYPE_INVALID;
        $this->validateErrors();
        return false;
        
    }

    public function validateErrors()
    {
        $image = $this->image;
        
        switch ($image['error']) {
            case UPLOAD_ERR_OK:
                break;
            case self::IMAGE_TYPE_INVALID:
                header("location: /register?aviso=4", true); // Nenhum arquivo encontrado
                exit;
            case UPLOAD_ERR_FORM_SIZE: // Maior que o limite do form html
                header("location: /register?aviso=5", true);
                exit;
            case UPLOAD_ERR_INI_SIZE: // Maior que o limite do php.ini
                header("location: /register?aviso=6", true);
                exit;
            default:
                echo "Erro desconhecido.";
                break;
        }
    }

    public function alocateImage($completePath)
    {
        $tempImageName = $this->image['tmp_name'];
        $isImageSaved = move_uploaded_file($tempImageName, $completePath);
        
        $this->setIsImageSaved($isImageSaved);
    }

    /* =-=-= Setters =-=-= */
    public function setImage(array $fileSubmitted)
    {
        $this->image = $fileSubmitted;
        if ($this->validateImage()) {
            $this->setPath();
        }
    }

    public function setIsEmpty(bool $boolean)
    {
        $this->isEmpty = $boolean;
    }

    public function setIsImageSaved(bool $boolean)
    {
        $this->isImageSaved = $boolean;
    }

    public function setPath()
    {
        if ($this->isEmpty) {
            $this->setIsImageSaved(true);
            $this->path = ("img\\uploads\\profile\\avatarAdm.png");
        } else {
            $imagem = $_FILES['image_src'];
            $pathRelativo = "img\\uploads\\profile\\";
            $nomeImagem = uniqid() . basename($imagem['name']);
            $pathCompleto = __DIR__ . "\\..\\..\\public\\$pathRelativo" . $nomeImagem;
            $this->alocateImage($pathCompleto);
            $this->path = $pathRelativo . $nomeImagem;
        }
    }
}
