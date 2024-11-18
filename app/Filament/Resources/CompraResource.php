<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CompraResource\Pages;
use App\Filament\Resources\CompraResource\RelationManagers;
use App\Models\Compra;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class CompraResource extends Resource
{
    protected static ?string $model = Compra::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    protected static ?string $navigationGroup = 'Operaciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Grid::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\Select::make('proveedor_id')
                                    ->label('Proveedor')
                                    ->searchable()
                                    ->preload()
                                    ->relationship('proveedor', 'razon_social')
                                    ->required(),
                                Forms\Components\Select::make('empleado_id')
                                    ->label('Empleado')
                                    ->searchable()
                                    ->preload()
                                    ->relationship('empleado', 'nombres')
                                    ->required(),
                                Forms\Components\DateTimePicker::make('fecha')
                                    ->default(now())
                                    ->required(),
                            ])
                            ->heading('Formulario')
                            ->columns(['xl' => 2, 'lg' => 2, 'md' => 1, 'sm' => 1])
                            ->columnSpan(['xl' => 3, 'lg' => 2, 'md' => 1, 'sm' => 1]),

                        Repeater::make('detalles')
                            ->relationship('detalles')
                            ->schema([
                                Select::make('producto_id')
                                    ->label('Producto')
                                    ->searchable()
                                    ->preload()
                                    ->relationship('producto', 'nombre')
                                    ->reactive()
                                    ->afterStateUpdated(fn($state, Forms\Set $set) => $set('precio_unitario', Producto::find($state)?->precio_unitario ?? 0))
                                    ->distinct()
                                    ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                    ->required(),
                                TextInput::make('cantidad')
                                    ->numeric()
                                    ->required(),
                                TextInput::make('precio_unitario')
                                    ->numeric()
                                    ->disabled()
                                    ->dehydrated()
                                    ->required(),
                            ])
                            ->columns(3)
                            ->defaultItems(1)
                            ->columnSpan(['xl' => 3, 'lg' => 2, 'md' => 1, 'sm' => 1]),
                    ])
                    ->columnSpan(['xl' => 3, 'lg' => 2, 'md' => 1, 'sm' => 1]),

                Grid::make()
                    ->schema([

                        Section::make()
                            ->schema([
                                Toggle::make('estado')
                                    ->label('Estado de validez')
                                    ->default(true)
                                    ->inline(false)
                            ])
                            ->heading('Opciones')
                            ->columnSpan(['xl' => 1, 'lg' => 1, 'md' => 1]),

                        Section::make()
                            ->schema([
                                Placeholder::make('created_at')
                                    ->label('Creación')
                                    ->content(fn(Compra $record): ?string => $record->created_at?->diffForHumans()),

                                Placeholder::make('updated_at')
                                    ->label('Última modificación')
                                    ->content(fn(Compra $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->heading('Información del registro')
                            ->hidden(fn(?Compra $record) => $record === null)
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
                Tables\Columns\TextColumn::make('proveedor.razon_social')
                    ->searchable()
                    ->label('Proveedor')
                    ->sortable(),
                Tables\Columns\TextColumn::make('empleado.nombres')
                    ->searchable()
                    ->label('Empleado')
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->searchable()
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->prefix('S/. ')
                    ->numeric(decimalPlaces: 2, locale: 'en_US')
                    ->getStateUsing(fn($record) => $record->total),
                Tables\Columns\IconColumn::make('estado')
                    ->label('Validez')
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
            'index' => Pages\ListCompras::route('/'),
            'create' => Pages\CreateCompra::route('/create'),
            'edit' => Pages\EditCompra::route('/{record}/edit'),
        ];
    }
}
