<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    public function getPathAttribute()
    {
        $url = $this->img_path;
        if(stristr($url, 'http') === false){
            $url = 'storage/'.$url;
        }
        return $url;
    }
}
