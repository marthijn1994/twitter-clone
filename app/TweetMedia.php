<?php

namespace App;

use App\Media\Media;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TweetMedia extends Model implements HasMedia
{

    use InteractsWithMedia;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function baseMedia()
    {
        return $this->belongsTo(Media::class, 'media_id');
    }

}
