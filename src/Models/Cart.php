<?php
namespace Ngogi\Xuongphp\Models;

use Ngogi\Xuongphp\Commons\Model;

class Cart extends Model
{
    protected string $tableName = 'carts';

    public function findbyUserID($userID){
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('user_id = ?')
            ->setParameter(0, $userID)
            ->fetchAssociative();
    }
}

