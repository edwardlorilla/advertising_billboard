<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
class Payment extends Model
{
    use SearchableTrait;
    protected $fillable = ['details', 'invoice_id'];
    protected $searchable = [
        'columns' => [
            'payments.details' => 1,
            'invoices.details' => 2

        ],
        'joins' => [
            'invoices' => ['payments.invoice_id', 'invoices.id']
        ]
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
