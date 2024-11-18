<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Filament\Resources\PedidoResource\RelationManagers;
use App\Models\Pedido;
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

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Operaciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Grid::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                Forms\Components\TextInput::make('id_cliente')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\DateTimePicker::make('fecha')
                                    ->default(now())
                                    ->required(),
                                Forms\Components\TextInput::make('descuento')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(100),
                                Select::make('tipo_comprobante')
                                    ->options([
                                        'B' => 'Boleta',
                                        'F' => 'Factura',
                                    ]),
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
                                    ->content(fn(Pedido $record): ?string => $record->created_at?->diffForHumans()),

                                Placeholder::make('updated_at')
                                    ->label('Última modificación')
                                    ->content(fn(Pedido $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->heading('Información del registro')
                            ->hidden(fn(?Pedido $record) => $record === null)
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
                Tables\Columns\TextColumn::make('cliente.nombres')
                    ->searchable()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fecha')
                    ->searchable()
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('descuento')
                    ->searchable()
                    ->numeric()
                    ->suffix('%')
                    ->numeric(decimalPlaces: 2, locale: 'en_US')
                    ->sortable(),
                Tables\Columns\TextColumn::make('tipo_comprobante')
                    ->formatStateUsing(function (string $state): string {
                        return match ($state) {
                            'F' => 'Factura',
                            'B' => 'Boleta',
                            default => $state,
                        };
                    })
                    ->searchable(),
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
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedido::route('/create'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }
}
