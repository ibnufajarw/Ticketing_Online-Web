<?php

namespace App\Models;

use App\Models\JenisTiket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tiket extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tiket';
    protected $guarded = [];

    public function jenisTiket()
    {
        return $this->belongsTo(JenisTiket::class, 'jenis_tiket_id');
    }
    public function keuntungans()
    {
        return $this->hasMany(Keuntungan::class, 'tiket_id');
    }
    
}
