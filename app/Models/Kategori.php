<?php

namespace App\Models;

use App\Models\Acara;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kategori';
    protected $guarded = [];
    public $timestamps = false;

    public function acara()
    {
        return $this->hasMany(Acara::class);
    }

    public function getNamaAttribute($value)
    {
        return ucwords($value);
    }
}
