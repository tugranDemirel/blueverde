<?php

namespace App\Enum\Customer;

enum CustomerIndividualEnum : int
{
    /*
     * Bireyse Müşteri =  INVIDUAL
     * Kurumsal Müşteri = INSTITUTIONAL
     * */
    case  INVIDUAL = 0;
    case INSTITUTIONAL = 1;
}
