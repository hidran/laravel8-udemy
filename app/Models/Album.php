<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
 //protected $table = 'albums';
 //protected $primaryKey ='id';
    protected $fillable = ['album_name','description','album_thumb','user_id'];
   public function getPathAttribute()
   {
       $url = $this->album_thumb;
       if(stristr($this->album_thumb, 'http') === false){
           $url = 'storage/'.$url;
       }
       return $url;
   }
    public function photos()
    {
 return $this->hasMany(Photo::class, 'album_id','id');
    }

}
