<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ip extends Model
{
    use HasFactory;
    protected $table = 'ip';
    protected $fillable = ['ip_address', 'status'];

    public function vps()
    {
        return $this->hasMany(Vps::class);
    }
}
