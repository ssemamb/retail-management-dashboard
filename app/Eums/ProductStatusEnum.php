<?php

namespace App\Eums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ProductStatusEnum: string implements HasLabel, HasColor
{
    case IN_STOCK = 'In stock';
    case SOLD_OUT = 'Sold Out';
    case COMMING_SOON = 'Comming Soon';

    public function getLabel(): string
    {
        return $this->value;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::IN_STOCK => 'success',
            self::SOLD_OUT => 'danger',
            self::COMMING_SOON => 'gray'
        };
    }
}
