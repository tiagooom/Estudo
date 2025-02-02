<?php

namespace App\Policies;

use App\Models\Artigo;
use App\Models\User;

class ArtigoPolicy
{
    /**
     * O usuário pode visualizar qualquer artigo?
     */
    public function viewAny(User $user): bool
    {
        return true; // Todos podem visualizar artigos
    }

    /**
     * O usuário pode visualizar um artigo específico?
     */
    public function view(User $user, Artigo $artigo): bool
    {
        return true; // Todos podem visualizar artigos
    }

    /**
     * O usuário pode criar um artigo?
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * O usuário pode atualizar este artigo?
     */
    public function update(User $user, Artigo $artigo): bool
    {
        return $user->id === $artigo->user_id || $user->role === 'admin';
    }

    /**
     * O usuário pode excluir este artigo?
     */
    public function delete(User $user, Artigo $artigo): bool
    {
        return $user->id === $artigo->user_id || $user->role === 'admin';
    }

    /**
     * O usuário pode restaurar um artigo deletado?
     */
    public function restore(User $user, Artigo $artigo): bool
    {
        return $user->role === 'admin'; // Apenas admins podem restaurar
    }

    /**
     * O usuário pode excluir permanentemente um artigo?
     */
    public function forceDelete(User $user, Artigo $artigo): bool
    {
        return $user->role === 'admin'; // Apenas admins podem deletar permanentemente
    }
}

