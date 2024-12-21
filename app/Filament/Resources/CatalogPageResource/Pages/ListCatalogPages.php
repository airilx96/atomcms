<?php

namespace App\Filament\Resources\CatalogPageResource\Pages;

use App\Filament\Resources\CatalogPageResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCatalogPages extends ListRecords
{
    protected static string $resource = CatalogPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
