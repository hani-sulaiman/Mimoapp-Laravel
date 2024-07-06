<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Folder;

class Note extends Model
{
    use HasFactory;
    protected $table = "note";
    protected $fillable = ['title','content','user_id','created_at'];
    
    public function user(){
        return $this->hasOne(User::class);
    }
    public function folder()
    {
        return $this->belongsTo(Folder::class, 'folder_id');
    }
}
