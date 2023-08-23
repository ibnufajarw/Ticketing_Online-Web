<?php

namespace App\Models;

use App\Models\Acara;
use App\Models\Lokasi;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kampus extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'kampus';
    protected $fillable = [
        'lokasi_id',
        'thumbnail',
        'nama'
    ];
    public $timestamps = false;  

    public function lokasi()
    {
        return $this->belongsTo('lokasi_id', Lokasi::class);
    }

    public function acara()
    {
        return $this->hasMany(Acara::class);
    }
}
