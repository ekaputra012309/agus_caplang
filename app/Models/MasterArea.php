<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterArea extends Model
{
    use HasFactory;
    protected $table = 'master_area_outlet';

    protected $fillable = [
        'area',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
