<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Eums\ProductStatusEnum;
use App\Filament\Tables\CategoriesTable;
use Filament\Forms\Components\ModalTableSelect;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Factories\Relationship;

use function Laravel\Prompts\select;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required(),
                TextInput::make('price')->rule('numeric')->required()->prefix('Shs'),
                TextInput::make('description'),
                Radio::make('status')
                    ->options(ProductStatusEnum::class)
                    ->required(),
                Select::make('tags')
                    ->relationship('tags', 'name')
                    ->multiple(),
                ModalTableSelect::make('category_id')
                    ->relationship('category', 'name')
                    ->tableConfiguration(CategoriesTable::class)
            ]);
    }
}
