<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

/**
 * Mass assignment é controlado na camada de validação (Form Requests), não via $fillable —
 * ver Model::unguard() no AppServiceProvider.
 *
 * @property string|null $handler Identificador público (Route key — /p/{user:handler})
 * @property string|null $bio Resumo exibido na bio
 * @property string|null $avatar_path Caminho relativo no disco public (storage)
 */
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return HasMany<Link, $this>
     */
    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }

    public function avatarUrl(): ?string
    {
        if ($this->avatar_path === null) {
            return null;
        }

        return Storage::disk('public')->url($this->avatar_path);
    }

    /**
     * URLs públicas usam handler em vez de id: /p/meu-handler
     */
    public function getRouteKeyName(): string
    {
        return 'handler';
    }

    /**
     * Binding público: só resolve usuários com handler definido.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     *
     * @throws ModelNotFoundException
     */
    public function resolveRouteBinding($value, $field = null): Model
    {
        return $this->newQuery()
            ->where($field ?? $this->getRouteKeyName(), $value)
            ->whereNotNull('handler')
            ->firstOrFail();
    }
}
