<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
class Client extends Model
{
    use SearchableTrait;
    protected $fillable = ['details'];
    protected $searchable = [
        'columns' => [
            'clients.details' => 1
        ]
    ];
    public function billboardhireds()
    {
        return $this->morphMany(Billboardhired::class, 'subject');
    }
}
