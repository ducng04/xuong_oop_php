<?php

namespace Ngogi\Xuongphp\Models;

use Ngogi\Xuongphp\Commons\Model;

class Category extends Model
{
    protected string $tableName = 'categories';

    /**
     * Tìm kiếm danh mục theo tên.
     *
     * @param string $name Tên của danh mục cần tìm kiếm.
     * @return array|null Một mảng kết hợp chứa thông tin của danh mục nếu tìm thấy, hoặc null nếu không tìm thấy.
     */
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
