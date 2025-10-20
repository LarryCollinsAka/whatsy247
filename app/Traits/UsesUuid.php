<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait UsesUuid
{
    /**
     * Boot the trait. This method is automatically called by Eloquent
     * when the model is booted (if the trait method is named boot[TraitName]).
     *
     * It sets the necessary model properties for UUID usage and hooks into
     * the model's 'creating' event to generate the UUID.
     */
    protected static function bootUsesUuid(): void
    {
        // 1. Set model properties: The key is a string and is non-incrementing.
        // These lines are mandatory for Eloquent to treat the ID as a UUID string.
        static::creating(function (Model $model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     * Overrides the default Eloquent method.
     */
    public function getIncrementing(): bool
    {
        return false;
    }

    /**
     * Get the primary key type.
     * Overrides the default Eloquent method.
     */
    public function getKeyType(): string
    {
        return 'string';
    }
}