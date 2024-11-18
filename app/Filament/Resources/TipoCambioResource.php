<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TipoCambioResource\Pages;
use App\Filament\Resources\TipoCambioResource\RelationManagers;
use App\Models\TipoCambio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class TipoCambioResource extends Resource
{
    protected static ?string $model = TipoCambio::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Opciones';

    protected static ?string $modelLabel = 'tipo de cambio';

    protected static ?string $pluralModelLabel = 'tipos de cambio';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('moneda_origen')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('moneda_destino')
                    ->required()
                    ->maxLength(3),
                Forms\Components\TextInput::make('tasa')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('fecha')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('moneda_origen')
                    ->searchable(),
                Tables\Columns\TextColumn::make('moneda_destino')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tasa')
                    ->numeric(decimalPlaces: 4, locale: 'en_US')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->dateTime('Y-m-d H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTipoCambios::route('/'),
            // 'create' => Pages\CreateTipoCambio::route('/create'),
            // 'edit' => Pages\EditTipoCambio::route('/{record}/edit'),
        ];
    }
}
