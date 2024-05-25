<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KaryawanModel extends Model
{
    use HasFactory;
    protected $table = 'master_karyawan';
    protected $fillable = ['nama_lengkap', 'jabatan', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function masterHubkaryawan()
    {
        return $this->hasMany(MasterHubkaryawan::class, 'karyawan_id');
    }
}
