<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterOutlet extends Model
{
    use HasFactory;
    protected $table = 'master_outlet';

    protected $fillable = [
        'outlet',
        'area_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(MasterArea::class, 'area_id', 'id');
    }
}
