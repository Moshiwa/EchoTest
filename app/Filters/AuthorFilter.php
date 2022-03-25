<?php

namespace App\Filters;

class AuthorFilter extends QueryFilter
{
    public function date_birth($year)
    {
        return $this->builder->whereYear('date_birth', $year);
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
