<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashbond extends Model
{
    use HasFactory;
    protected $table = 'cashbond';
    protected $fillable = ['alasan', 'nominal', 'kredit', 'tanggal_pengajuan', 'status', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
