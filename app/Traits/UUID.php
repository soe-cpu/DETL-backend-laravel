<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait UUID
{
    protected static function bootUUID ()
    {
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
              $model->{$model->getKeyName()} = Str::uuid()->toString();

              if ($model->consecutive) {
                $model->consecutive = $model->max("consecutive") + 1;
              }
            }
          });
    }

    // Tells the database not to auto-increment this field
    public function getIncrementing ()
    {
        return false;
    }

    // Helps the application specify the field type in the database
    public function getKeyType ()
    {
        return 'string';
    }
}
