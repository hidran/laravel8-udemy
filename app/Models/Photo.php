<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
  protected $fillable =['name','img_path','description'];

    public function album()
    {
       return $this->belongsTo(Album::class);
  }
    public function getPathAttribute()
    {
        $url = $this->img_path;
        if($url && stristr($url, 'http') === false){
            $url = 'storage/'.$url;
        }
        return $url;
    }
    public function  getImgPathAttribute($value){

        if($value && stristr($value ,'http') === false){
            $value = 'storage/'.$value;
        }
        return $value;
    }
    public function  setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }
}
