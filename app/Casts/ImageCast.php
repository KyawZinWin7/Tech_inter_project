<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class ImageCast implements CastsAttributes
{
    /**
     * Add path to the value array(with loop) or string from storage.
     */
    public function get($model, $key, $value, $attributes)
    {
        $path = "http://127.0.0.1:8000/storage/images/";
        if ($value) {
            return $path . $value;
        }
        return null;
    }

    /**
     * Set the value directly to the storage.
     */
    public function set($model, $key, $value, $attributes)
    {
        return $value;
    }
}
