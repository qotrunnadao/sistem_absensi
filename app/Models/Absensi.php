<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';
    protected $fillable = ['user_id', 'jenis', 'foto', 'latitude', 'longitude',];
    protected $primaryKey = 'id';

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('d F Y H:i:s');
    }

    public function getUpdatedAtAttribute()
    {
        return Carbon::parse($this->attributes['updated_at'])->translatedFormat('d F Y H:i:s');
    }

    // public function getShowFotoAttribute()
    // {
    //     // dd($this->attributes);
    //     if (isset($this->attribute['foto'])) {
    //         return asset('storage/absensi/' . $this->attributes['foto']);
    //     } else {
    //         return asset('img/not-found.png');
    //     }
    // }
}


/* End of file Absensi.php */
/* Location: ./app/Models/Absensi.php */
/* Created at 2021-01-23 15:25:56 */
/* Mohammad Irham Akbar Laravel 8 CRUD Generator : */
