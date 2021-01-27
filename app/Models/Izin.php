<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Izin extends Model
{
    use HasFactory;
    protected $table = 'izin';
    protected $fillable = [
        'user_id',
        'keterangan',
        'tgl_mulai',
        'tgl_berakhir',
        'status',
    ];
    protected $primaryKey = 'id';

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}


/* End of file Izin.php */
/* Location: ./app/Models/Izin.php */
/* Created at 2021-01-23 15:26:03 */
/* Mohammad Irham Akbar Laravel 8 CRUD Generator : */
