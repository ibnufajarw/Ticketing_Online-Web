<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kampus;
use App\Models\Lokasi;
use App\Models\Kategori;
use App\Models\JenisTiket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acara extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'acara';
    protected $guarded = [];
    protected $casts = [
        'waktu_mulai' => 'datetime'
    ];

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kampus()
    {
        return $this->belongsTo(Kampus::class, 'kampus_id');
    }

    public function jenisTiket()
    {
        return $this->hasONe(JenisTiket::class);
    }

    public function jenisTiketGratis()
    {
        return $this->hasOne(JenisTiket::class)->where('is_free', '=', 1);
    }

    public function jenisTiketBerbayar()
    {
        return $this->hasOne(JenisTiket::class)->where('is_free', '=', 0);
    }

}
