<?php


namespace App\Media;


class MimeTypes
{

    /**
     * Allowed images types to be uploaded
     *
     * @var array
     */
    public static $image = [
        'image/png',
        'image/jpg',
        'image/jpeg',
    ];

    /**
     * Allowed video types to be uploaded
     *
     * @var array
     */
    public static $video = [
        'video/mp4'
    ];

    /**
     * @param $mime
     * @return string
     */
    public static function type($mime): string
    {
        $type = '';
        if (in_array($mime, self::$image, true)) {
            $type = 'image';
        } else if (in_array($mime, self::$video, true)) {
            $type = 'video';
        }
        return $type;
    }

    /**
     * @return array
     */
    public static function all()
    {
        return array_merge(self::$image, self::$video);
    }

}
