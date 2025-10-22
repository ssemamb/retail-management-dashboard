<?php

namespace App\Filament\pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class Dashboard extends \Filament\Pages\Dashboard
{

    use HasFiltersForm;

    public function filtersForm(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make([

                    DatePicker::make('Start_date'),
                    DatePicker::make('End_date')
                ])->columns(2)
                    ->columnSpanFull()
            ]);
    }
}
