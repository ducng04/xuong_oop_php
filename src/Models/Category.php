<?php

namespace Ngogi\Xuongphp\Models;

use Ngogi\Xuongphp\Commons\Model;

class Category extends Model
{
    protected string $tableName = 'categories';

    
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
