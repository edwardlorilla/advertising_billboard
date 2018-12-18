<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
class Agency extends Model
{
    use SearchableTrait;
    protected $fillable = ['details'];
    protected $searchable = [
        'columns' => [
            'agencies.details' => 1
        ]
    ];

    public function billboardhireds()
    {
        return $this->morphMany(Billboardhired::class, 'subject');
    }
}
