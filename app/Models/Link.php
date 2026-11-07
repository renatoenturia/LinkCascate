<?php

namespace App\Models;

use Database\Factories\LinkFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property int $user_id
 * @property string $title
 * @property string $url
 * @property int $position
 * @property bool $is_active
 */
class Link extends Model
{
    /** @use HasFactory<LinkFactory> */
    use HasFactory;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'position' => 'integer',
        ];
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Route Model Binding: {link} nas rotas resolve para um registro deste model.
     *
     * Equivale a auth()->user()->links()->whereKey($value)->firstOrFail() — 404 se o id
     * não existir ou não pertencer ao usuário logado.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     *
     * @throws ModelNotFoundException
     */
    public function resolveRouteBinding($value, $field = null): Model
    {
        $user = auth()->user();

        if ($user === null) {
            throw (new ModelNotFoundException)->setModel(static::class, [$value]);
        }

        return $user->links()
            ->where($field ?? $this->getRouteKeyName(), $value)
            ->firstOrFail();
    }
}
