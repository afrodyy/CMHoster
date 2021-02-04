<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datacenter extends Model
{
    use HasFactory;
    protected $table = 'datacenter';
    protected $fillable = ['lokasi', 'alamat'];

    public function location()
    {
        return $this->hasMany(Location::class);
    }

    public function vps()
    {
        return $this->hasMany(Vps::class);
    }
}
