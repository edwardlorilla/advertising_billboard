<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
class Billboard extends Model
{
use SearchableTrait;
protected $fillable = ['details'];
protected $searchable = [
'columns' => [
'billboards.details' => 1
]
];
}
