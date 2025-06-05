<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        $restrictedStates = ['suspended', 'banned', 'archived'];

        // Check if state was changed
        if ($user->isDirty('state')) {
            // Se for uma eliminação voluntária (o nome foi alterado para "Utilizador Eliminado")
            if ($user->state === 'archived' && $user->isDirty('name') && $user->name === 'Utilizador Eliminado') {
                $this->handleAccountDeletion($user);
            }
            // If changed to a restricted state
            elseif (in_array($user->state, $restrictedStates)) {
                $this->deactivateUserContent($user);
            }
            // If changed from a restricted state to active
            elseif ($user->state === 'active' && in_array($user->getOriginal('state'), $restrictedStates)) {
                $this->reactivateUserContent($user);
            }
        }
    }

    /**
     * Tratamento específico para eliminação voluntária da conta
     */
    protected function handleAccountDeletion(User $user): void
    {
        // Deactivate properties
        $user->properties()->update(['is_active' => false]);

        // Archive advertisements
        $user->advertisements()->update(['is_published' => false]);
        $user->advertisements()->update(['is_suspended' => true]);

        // NÃO elimina os pedidos de contacto
        // Apenas encerra as sessões
        $this->logoutUserFromAllDevices($user);
    }

    /**
     * Deactivate all content created by the user
     */
    protected function deactivateUserContent(User $user): void
    {
        // Deactivate properties
        $user->properties()->update(['is_active' => false]);

        // Archive advertisements
        $user->advertisements()->update(['is_published' => false]);
        $user->advertisements()->update(['is_suspended' => true]);

        // Eliminar todos os pedidos de contacto relacionados aos anúncios do utilizador
        foreach ($user->advertisements as $advertisement) {
            $advertisement->requests()->delete();
        }

        \App\Models\ContactRequest::where('created_by', $user->id)->delete();

        // Encerrar todas as sessões do utilizador
        $this->logoutUserFromAllDevices($user);
    }

    /**
     * Termina a sessão do utilizador em todos os dispositivos
     */
    protected function logoutUserFromAllDevices(User $user): void
    {
        // Termina a sessão do utilizador
        \DB::table('sessions')
            ->where('user_id', $user->id)
            ->delete();
    }

    /**
     * Reactivate properties when user becomes active again
     * Advertisements will remain archived
     */
    protected function reactivateUserContent(User $user): void
    {
        // Reactivate only the properties
        $user->properties()->update(['is_active' => true]);

        // Advertisements remain in archived state
    }
}
