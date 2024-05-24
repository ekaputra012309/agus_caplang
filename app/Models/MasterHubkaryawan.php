<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterHubkaryawan extends Model
{
    use HasFactory;
    protected $table = 'master_hubkaryawan';

    protected $fillable = [
        'karyawan_id',
        'nama_tl',
        'area',
        'user_id',
    ];

    public function karyawan()
    {
        return $this->belongsTo(KaryawanModel::class, 'karyawan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
