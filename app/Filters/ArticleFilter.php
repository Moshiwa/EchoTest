<?php

namespace App\Filters;

use App\Models\Article;
use Illuminate\Support\Facades\Schema;

class ArticleFilter extends QueryFilter
{
    public function author($id)
    {
        return $this->builder->where('author_id', $this->paramToArray($id));
    }

    public function category($id)
    {
        return $this->builder->where('category_id', $this->paramToArray($id));
    }

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
