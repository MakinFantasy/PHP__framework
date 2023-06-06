<?php
namespace Models\Users;

use Models\ActiveRecordEntity;




class User extends ActiveRecordEntity
{
    protected $id;
    protected $nickname;
    protected $email;
    protected $isConfirmed;
    protected $role;
    protected $passwordHash;
    protected $authToken;
    protected $createdAt;


    public function getNickname(): string
    {
        return $this->nickname;
    }

    public function setNickname(string $nickname)
    {
        $this->nickname = $nickname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getrole()
    {
        return $this->role;
    }

    public static function getTableName(): string
    {
        return 'users';
    }

}