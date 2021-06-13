<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Photo
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string $name
 * @property string|null $description
 * @property int $album_id
 * @property string $img_path
 * @property-read \App\Models\Album $album
 * @property-read mixed $path
 * @method static \Database\Factories\PhotoFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereAlbumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereImgPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Photo whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
