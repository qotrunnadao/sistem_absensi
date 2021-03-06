<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Libur extends Model
{
    use HasFactory;
    protected $table = 'libur';
    protected $fillable = ['nama_libur', 'tanggal', 'keterangan',];
    protected $primaryKey = 'id';


    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('d F Y H:i:s');
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->translatedFormat('d F Y H:i:s');
    }
}
