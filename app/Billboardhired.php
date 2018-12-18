<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
class Billboardhired extends Model
{
    use SearchableTrait;
    protected $fillable = ['billboard_id', ];
    protected $searchable = [
        'columns' => [
            'billboards.details' => 1
        ],
        'joins' => [
            'billboards' => ['billboardhireds.billboard_id', 'billboards.id']
        ]
    ];

    public function billboard()
    {
        return $this->belongsTo(Billboard::class);
    }
    public function subject()
    {
        return $this->morphTo();
    }
    public function agency()
    {
        return $this->belongsTo(Agency::class, 'subject_id')
            ->where('billboardhireds.subject_type', Agency::class);
    }
    public function client()
    {
        return $this->belongsTo(Client::class, 'subject_id')
            ->where('billboardhireds.subject_type', Client::class);
    }
}
