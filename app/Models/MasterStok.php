<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterStok extends Model
{
    use HasFactory;
    protected $table = 'table_master_stok';

    protected $fillable = [
        'spg_id',
        'area',
        'outlet_id',
        'sku',
        'stok',
        'user_id',
    ];

    public function spg()
    {
        return $this->belongsTo(KaryawanModel::class, 'spg_id');
    }

    public function outlet()
    {
        return $this->belongsTo(MasterOutlet::class, 'outlet_id');
    }

    public function Sku()
    {
        return $this->belongsTo(MasterSku::class, 'sku');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
