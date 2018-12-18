<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
class Invoice extends Model
{
    use SearchableTrait;
    protected $fillable = ['details', 'billboardhired_id'];
    protected $searchable = [
        'columns' => [
            'invoices.details' => 1,
            'billboardhireds.date_hired_from' => 2,
            'billboardhireds.date_hired_to' => 3
        ],
        'joins' => [
            'billboardhireds' => [ 'billboardhireds.id', 'invoices.billboardhired_id'],
        ]
    ];

    public function billboardhired()
    {
        return $this->belongsTo(Billboardhired::class);
    }
}
