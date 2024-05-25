<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSku extends Model
{
    use HasFactory;
    protected $table = 'master_sku';

    protected $fillable = [
        'sku',
        'brand',
        'kategori',
        'keterangan',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
