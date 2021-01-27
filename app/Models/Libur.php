<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libur extends Model
{
    use HasFactory;
    protected $table = 'libur';
    protected $fillable = ['nama_libur','tanggal','keterangan',];
    protected $primaryKey = 'id';
}


/* End of file Libur.php */
/* Location: ./app/Models/Libur.php */
/* Created at 2021-01-22 08:54:20 */
/* Mohammad Irham Akbar Laravel 8 CRUD Generator : */