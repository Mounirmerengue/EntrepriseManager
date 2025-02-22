<?php

namespace App\Enum;

enum OrderStatus: string
{
    case UNPROCESSED = 'non traité';
    case PROCESSED = 'traité';
    case CANCELED = 'annulé';
}