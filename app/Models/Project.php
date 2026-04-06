<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'pembuat',
        'kelas',
        'deskripsi',
        'image',
        'link',
        'qr_path',
        'status',
    ];

    // Scope: hanya project yang sudah di-accept
    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    // Scope: project yang menunggu review
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
