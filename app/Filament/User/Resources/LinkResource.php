<?php

namespace App\Filament\User\Resources;

use App\Filament\User\Resources\LinkResource\Pages;
use App\Filament\User\Resources\LinkResource\RelationManagers;
use App\Filament\User\Resources\LinkResource\Widgets\CustomerOverview;
use App\Models\Link;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class LinkResource extends Resource
{
    protected static ?string $model = Link::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', auth()->id());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('original_url')
                    ->label('Оригинальный URL')
                    ->required()
                    ->url(),
                TextInput::make('short_code')
                    ->label('Короткий URL')
                    ->required()
                    ->url(fn ($record) => url('/' . $record->short_code)),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('ID'),
                TextColumn::make('original_url')->label('Оригинальный URL'),
                TextColumn::make('short_code')->label('Короткий код')->url(fn ($record) => url('/' . $record->short_code))->openUrlInNewTab(),
                TextColumn::make('created_at')->dateTime()->label('Создано'),
                TextColumn::make('clicks_count')
                    ->counts('clicks')
                    ->label('Переходов'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ClicksRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLinks::route('/'),
            'create' => Pages\CreateLink::route('/create'),
            'view' => Pages\ViewLink::route('/{record}'),
        ];
    }
    public static function canEdit($record): bool
    {
        return false;
    }
    public static function getWidgets(): array
    {
        return [
            CustomerOverview::class
        ];
    }

}
