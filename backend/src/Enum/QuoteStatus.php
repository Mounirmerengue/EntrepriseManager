<?php

namespace App\Enum;

enum QuoteStatus: string
{
    case ACCEPTED = 'accepté';
    case DENIED = 'refusé';
    case PENDING = 'en attente';
}