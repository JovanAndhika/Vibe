<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    use HasFactory;
    protected $table = 'music';
    protected $fillable = [
        'title',
        'artist',
        'genre',
        'file_path',
        'icon',
        'release_date',
        'category_id',
        'file_public_id',
        'icon_public_id',
    ];
    public $timestamps = false;
    

    // untuk filter search
    // memanggil dengan Music::filter()
    // parameter adalah request apa yang ingin di filter dimana itu berisi keywordnya
    public function scopeFilter($query, $keyword, $searchBy)
    {
        if ($searchBy == 'artist') return $query->where('artist', 'like', '%' . $keyword . '%');
        if ($searchBy == 'title') return $query->where('title', 'like', '%' . $keyword . '%');
    }

    // Relation
    public function playlists()
    {
        return $this->belongsToMany(Playlist::class);
    }
}
