<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    use HasFactory;
    protected $table = 'table_event';
    protected $fillable = [
        'nama_tl',
        'spg1',
        'spg2',
        'tanggal',
        'sku',
        'qty',
        'harga_satuan',
        'total_penjualan',
        'target_penjualan',
        'user_id',
    ];

    public function tl()
    {
        return $this->belongsTo(MasterHubkaryawan::class, 'nama_tl', 'id');
    }

    public function spgOne()
    {
        return $this->belongsTo(KaryawanModel::class, 'spg1', 'id');
    }

    public function spgTwo()
    {
        return $this->belongsTo(KaryawanModel::class, 'spg2', 'id');
    }

    public function Sku()
    {
        return $this->belongsTo(MasterSku::class, 'sku', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
