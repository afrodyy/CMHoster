<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vps extends Model
{
    use HasFactory;
    protected $table = 'vps';
    protected $fillable = ['nama', 'client_id', 'ip_id', 'location_id', 'status'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function ip()
    {
        return $this->belongsTo(Ip::class);
    }
}
