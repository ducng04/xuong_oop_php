<?php
namespace Ngogi\Xuongphp\Models;

use Ngogi\Xuongphp\Commons\Model;

class Product extends Model
{
    protected string $tableName = 'products';

    public function findByName(string $name): ?array
    {
        return $this->queryBuilder
            ->select('*')
            ->from($this->tableName)
            ->where('name = ?')
            ->setParameter(0, $name)
            ->fetchAssociative();
    }
}

