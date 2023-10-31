<?php

namespace App\Enum\Customer;

enum CustomerPersonalTypeEnum :int
{
    /*
     * Yurtiçi Müşteri = DOMESTIC_CUSTOMER
     * Yurtdışı Müşteri = OVERSEAS_CUSTOMER
     * */
    case DOMESTIC_CUSTOMER = 0;
    case OVERSEAS_CUSTOMER = 1;
}
