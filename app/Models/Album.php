<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\Album
 *
 * @property int $id
 * @property string $album_name
 * @property string $album_thumb
 * @property string|null $description
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read mixed $path
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Photo[] $photos
 * @property-read int|null $photos_count
 * @method static \Database\Factories\AlbumFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Album newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Album newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Album query()
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereAlbumName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereAlbumThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereUserId($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Category[] $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\User $user
 */
class Album extends Model
{
    use HasFactory;

    //protected $table = 'albums';
    //protected $primaryKey ='id';
    protected $fillable = ['album_name', 'description', 'album_thumb', 'user_id'];

    public function getPathAttribute()
    {
        $url = $this->album_thumb;
        if (stristr($this->album_thumb, 'http') === false) {
            $url = 'storage/' . $url;
        }
        return $url;
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'album_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        // album_category , album_id, category_id
        return $this->belongsToMany(Category::class)->withTimestamps();
    }
}

