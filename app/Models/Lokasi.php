<?php

namespace App\Models;

use App\Models\Acara;
use App\Models\Kampus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lokasi extends Model
{
    use HasFactory;

    protected $table = 'lokasi';
    protected $fillable = [
        'nama'
    ];
    public $timestamps = false;

    public function acara()
    {
        return $this->hasMany(Acara::class);
    }

    public function kampus()
    {
        return $this->hasMany(Kampus::class);
    }
}
