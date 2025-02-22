<?php

namespace App\Enum;

enum DeliveryStatus: string
{
    case PENDING = 'en attente';
    case SHIPPED = 'envoyé';
    case DELIVERED = 'livré';
    case CANCELED = 'annulé';
}