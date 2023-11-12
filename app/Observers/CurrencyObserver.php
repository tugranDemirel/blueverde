<?php

namespace App\Observers;

use App\Models\SystemCurrency;

class CurrencyObserver
{
    /**
     * Handle the SystemCurrency "created" event.
     */
    public function saving(SystemCurrency $systemCurrency): void
    {
        $systemCurrency->name = mb_strtoupper(turkishToEnglishChars($systemCurrency->name));
        $systemCurrency->code = mb_strtoupper(turkishToEnglishChars($systemCurrency->code));
        $systemCurrency->symbol = mb_strtoupper($systemCurrency->symbol);
    }

    /**
     * Handle the SystemCurrency "updated" event.
     */
    public function updated(SystemCurrency $systemCurrency): void
    {
        //
    }

    /**
     * Handle the SystemCurrency "deleted" event.
     */
    public function deleted(SystemCurrency $systemCurrency): void
    {
        //
    }

    /**
     * Handle the SystemCurrency "restored" event.
     */
    public function restored(SystemCurrency $systemCurrency): void
    {
        //
    }

    /**
     * Handle the SystemCurrency "force deleted" event.
     */
    public function forceDeleted(SystemCurrency $systemCurrency): void
    {
        //
    }
}
