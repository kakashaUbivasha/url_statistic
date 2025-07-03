<?php

namespace App\Filament\User\Resources\LinkResource\Pages;

use App\Filament\User\Resources\LinkResource;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
class ViewLink extends ViewRecord
{
    protected static string $resource = LinkResource::class;
    public function schema(): array
    {
        return [
            TextEntry::make('original_url')->label('Оригинальный URL'),
            TextEntry::make('short_code')
                ->label('Короткая ссылка')
                ->url(fn($record) => url('/' . $record->short_code))
                ->openUrlInNewTab()
                ->copyable(),
        ];
    }
}
