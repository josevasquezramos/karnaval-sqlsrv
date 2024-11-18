<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProveedorResource\Pages;
use App\Filament\Resources\ProveedorResource\RelationManagers;
use App\Models\Proveedor;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ProveedorResource extends Resource
{
    protected static ?string $model = Proveedor::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Core';

    protected static ?string $modelLabel = 'proveedor';

    protected static ?string $pluralModelLabel = 'proveedores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('ruc')
                            ->required()
                            ->maxLength(11),
                        Forms\Components\TextInput::make('razon_social')
                            ->required()
                            ->maxLength(200),
                        Forms\Components\TextInput::make('celular')
                            ->maxLength(15),
                        Forms\Components\Textarea::make('direccion')
                            ->columnSpanFull(),
                    ])
                    ->heading('Formulario')
                    ->columns(['xl' => 2, 'lg' => 2, 'md' => 2, 'sm' => 1])
                    ->columnSpan(['xl' => 3, 'lg' => 2, 'md' => 1, 'sm' => 1]),

                Grid::make()
                    ->schema([

                        Section::make()
                            ->schema([
                                Toggle::make('estado')
                                    ->label('Estado de actividad en el sistema')
                                    ->default(true)
                                    ->inline(false)
                            ])
                            ->heading('Opciones')
                            ->columnSpan(['xl' => 1, 'lg' => 1, 'md' => 1]),

                        Section::make()
                            ->schema([
                                Placeholder::make('created_at')
                                    ->label('Creación')
                                    ->content(fn(Proveedor $record): ?string => $record->created_at?->diffForHumans()),

                                Placeholder::make('updated_at')
                                    ->label('Última modificación')
                                    ->content(fn(Proveedor $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->heading('Información del registro')
                            ->hidden(fn(?Proveedor $record) => $record === null)
                            ->columns(['xl' => 1, 'lg' => 2, 'md' => 2, 'sm' => 1])
                            ->columnSpan(['xl' => 1, 'lg' => 2, 'md' => 1, 'sm' => 1]),
                    ])
                    ->columns(['xl' => 1, 'lg' => 2, 'md' => 2, 'sm' => 1])
                    ->columnSpan(['xl' => 1, 'lg' => 2, 'md' => 1, 'sm' => 1])
            ])->columns(['xl' => 4, 'lg' => 1, 'md' => 1, 'sm' => 1]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ruc')
                    ->searchable(),
                Tables\Columns\TextColumn::make('razon_social')
                    ->searchable(),
                Tables\Columns\TextColumn::make('celular')
                    ->searchable(),
                Tables\Columns\IconColumn::make('estado')
                    ->boolean(),
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
            'index' => Pages\ListProveedors::route('/'),
            'create' => Pages\CreateProveedor::route('/create'),
            'edit' => Pages\EditProveedor::route('/{record}/edit'),
        ];
    }
}
