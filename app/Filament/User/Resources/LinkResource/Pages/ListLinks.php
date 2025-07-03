<?php

namespace App\Filament\User\Resources\LinkResource\Pages;

use App\Filament\User\Resources\LinkResource;
use Filament\Actions;
use Filament\Pages\Concerns\ExposesTableToWidgets;
use Filament\Resources\Pages\ListRecords;

class ListLinks extends ListRecords
{
    protected static string $resource = LinkResource::class;
    use ExposesTableToWidgets;
    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    protected function getFooterWidgets(): array
    {
        return [
            LinkResource\Widgets\CustomerOverview::class
        ];
    }
}
