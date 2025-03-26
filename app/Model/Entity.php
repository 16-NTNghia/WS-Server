<?php
namespace WorkSpace\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Entity extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $attributes = [
        'IsDeleted' => false,
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $key = $model->getKeyName();
            if (empty($model->{$key})) {
                $model->{$key} = Str::uuid()->toString();
            }
        });
    }
}