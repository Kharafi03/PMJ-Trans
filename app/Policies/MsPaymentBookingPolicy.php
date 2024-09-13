<?php

namespace App\Policies;

use App\Models\User;
use App\Models\MsPaymentBooking;
use Illuminate\Auth\Access\HandlesAuthorization;

class MsPaymentBookingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_ms::payment::booking');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, MsPaymentBooking $msPaymentBooking): bool
    {
        return $user->can('view_ms::payment::booking');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_ms::payment::booking');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, MsPaymentBooking $msPaymentBooking): bool
    {
        return $user->can('update_ms::payment::booking');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, MsPaymentBooking $msPaymentBooking): bool
    {
        return $user->can('delete_ms::payment::booking');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_ms::payment::booking');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, MsPaymentBooking $msPaymentBooking): bool
    {
        return $user->can('force_delete_ms::payment::booking');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_ms::payment::booking');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, MsPaymentBooking $msPaymentBooking): bool
    {
        return $user->can('restore_ms::payment::booking');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_ms::payment::booking');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, MsPaymentBooking $msPaymentBooking): bool
    {
        return $user->can('replicate_ms::payment::booking');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_ms::payment::booking');
    }
}
