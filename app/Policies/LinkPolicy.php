<?php

namespace App\Policies;

use App\Models\Link;
use App\Models\User;

/**
 * Permissões do módulo Link: sempre baseadas no dono do registro (user_id).
 */
class LinkPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Link $link): bool
    {
        return $this->owns($user, $link);
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Link $link): bool
    {
        return $this->owns($user, $link);
    }

    public function delete(User $user, Link $link): bool
    {
        return $this->owns($user, $link);
    }

    /**
     * Subir/descer na cascata — mesma regra de alteração do registro.
     */
    public function reorder(User $user, Link $link): bool
    {
        return $this->owns($user, $link);
    }

    private function owns(User $user, Link $link): bool
    {
        return $user->id === $link->user_id;
    }
}
