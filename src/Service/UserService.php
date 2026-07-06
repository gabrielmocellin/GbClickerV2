<?php

namespace GbClicker\Service;

use GbClicker\DAO\UserDAO;
use GbClicker\DAO\InventarioDAO;
use GbClicker\Model\UserModel;

class UserService
{
    private UserDAO $userDao;
    private InventarioDAO $inventarioDao;

    public function __construct(UserDAO $userDao, InventarioDAO $inventarioDao)
    {
        $this->userDao = $userDao;
        $this->inventarioDao = $inventarioDao;
    }

    public function findByEmail(string $email): ?UserModel
    {
        $userData = $this->userDao->selectByEmail($email);
        if ($userData) {
            $userModel = new UserModel();
            $userModel->setEmail($email);
            $userModel->setAllUserData($userData);
            
            $inventario = $this->inventarioDao->selectByUserEmail($email);
            $userModel->upgradesInfo->carregarInventario($inventario);
            
            return $userModel;
        }
        return null;
    }

    public function authenticateByEmailAndPassword(string $email, string $password): ?UserModel
    {
        $userData = $this->userDao->selectByEmail($email);
        if ($userData) {
            $senhaValida = password_verify($password, $userData['password']);
            if ($senhaValida) {
                $userModel = new UserModel();
                $userModel->setEmail($email);
                $userModel->setAllUserData($userData);
                
                $inventario = $this->inventarioDao->selectByUserEmail($email);
                $userModel->upgradesInfo->carregarInventario($inventario);
                
                return $userModel;
            }
        }
        return null;
    }

    public function save(UserModel $model): bool
    {
        return $this->userDao->insert($model);
    }

    public function updateMoney(UserModel $model): bool
    {
        return $this->userDao->update($model);
    }

    public function updateUserData(UserModel $model): bool
    {
        return $this->userDao->update($model);
    }

    public function listPaginated(int $page, string $search = ''): array
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $contasData = $this->userDao->selectTenPerPage($offset, $limit, $search);
        
        $contas = [];
        foreach ($contasData as $conta) {
            $model = new UserModel();
            $model->setId($conta['id']);
            $model->setEmail($conta['email']);
            $model->setNickname($conta['nickname']);
            $model->setImageSrc($conta['image_src']);
            $model->setMoney($conta['money']);
            $model->getLevelData()->setLevel($conta['level']);
            $contas[] = $model;
        }
        return $contas;
    }

    public function countAccounts(string $search = ''): int
    {
        return $this->userDao->countTotalAccounts($search);
    }
    
    public function updateMoneyAndLevel($email, $money, $levelData): bool
    {
        return $this->userDao->updateMoneyAndLevel($email, $money, $levelData);
    }
    
    public function addMoney($email, $amount): bool
    {
        return $this->userDao->addMoney($email, $amount);
    }
}
