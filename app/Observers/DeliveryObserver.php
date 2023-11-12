<?php

namespace App\Observers;

use App\Models\SystemDeliveryMethod;

class DeliveryObserver
{
    /**
     * Handle the SystemDeliveryMethod "created" event.
     */
    public function saving(SystemDeliveryMethod $deliveryMethod): void
    {
        $deliveryMethod->code = mb_strtoupper(turkishToEnglishChars($deliveryMethod->code));
    }
    /**
     * Handle the SystemDeliveryMethod "updated" event.
     */
    public function updated(SystemDeliveryMethod $deliveryMethod): void
    {
        //
    }

    /**
     * Handle the SystemDeliveryMethod "deleted" event.
     */
    public function deleted(SystemDeliveryMethod $deliveryMethod): void
    {
        //
    }

    /**
     * Handle the SystemDeliveryMethod "restored" event.
     */
    public function restored(SystemDeliveryMethod $deliveryMethod): void
    {
        //
    }

    /**
     * Handle the SystemDeliveryMethod "force deleted" event.
     */
    public function forceDeleted(SystemDeliveryMethod $deliveryMethod): void
    {
        //
    }
}
