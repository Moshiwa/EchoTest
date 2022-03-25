<?php

namespace App\Filters;

class CategoryFilter extends QueryFilter
{
    public function search($name)
    {
        return $this->builder->where('name', $name);
    }

    public function sort($columnName)
    {
        if ($columnName[0] === '*') {
            $modify = 'ASC';
        } else {
            $modify = 'DESC';
        }

        $columnName = trim($columnName, '*');

        if (in_array(
            $columnName,
            \Schema::getColumnListing($this->table)
        )) {
            return $this->builder->orderBy($columnName, $modify);
        }
    }
}
