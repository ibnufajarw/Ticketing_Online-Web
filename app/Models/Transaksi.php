<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }
    public function tiket()
    {
        return $this->belongsTo(Tiket::class)->withTrashed();
    }
    public function acara()
    {
        return $this->belongsTo(Acara::class)->withTrashed();
    }
}
