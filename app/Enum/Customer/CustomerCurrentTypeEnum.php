<?php

namespace App\Enum\Customer;

enum CustomerCurrentTypeEnum : int
{
    /*
     * cari = Current
     * cari değil  = Not current
     * */
    case CURRENT = 0;
    case NOT_CURRENT = 1;

}
