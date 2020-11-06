<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vps extends Model
{
    use HasFactory;
    protected $table = 'vps';
    protected $fillable = ['nama', 'ip_address', 'lokasi', 'status', 'client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
