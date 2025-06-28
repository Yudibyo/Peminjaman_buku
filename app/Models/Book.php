<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * Nama primary key
     * @var string
     */
    protected $primaryKey = 'id_buku';

    /**
     * Kolom yang dapat diisi massal
     * @var array
     */
    protected $fillable = [
        'judul', 
        'penulis', 
        'penerbit', 
        'tahun_terbit', 
        'kategori', 
        'stok',
        'cover',
        'deskripsi'
    ];

    /**
     * Relasi ke model Peminjaman
     */
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_buku');
    }
}