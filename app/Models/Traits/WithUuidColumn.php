<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Model;

trait WithUuidColumn
{
    protected static function bootWithUuidColumn()
    {
        static::creating(function (Model $model) {
            if (! $model->getKey()) {
                $uuid = @$model->{$model->getUuidKey()};
                $model->{$model->getUuidKey()} = (!is_null($uuid) && \Str::isUuid($uuid)) ? $uuid : \Str::uuid()->toString();
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return $this->getUuidKey();
    }

    public function getUuidKey(): string
    {
        return 'uuid';
    }
}
