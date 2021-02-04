<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    protected $table = 'location';
    protected $fillable = ['nama', 'tanggal', 'spesifikasi', 'datacenter_id'];

    public function datacenter()
    {
        return $this->belongsTo(Datacenter::class);
    }

    public function vps()
    {
        return $this->hasMany(Vps::class);
    }
}
