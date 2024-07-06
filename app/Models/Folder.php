<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Notes;

class Folder extends Model
{
    use HasFactory;
    protected $table = 'folder';
    protected $fillable = ['title', 'note_id'];

    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
