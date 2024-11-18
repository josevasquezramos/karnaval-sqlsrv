<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Producto;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationGroup = 'Core';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->maxLength(200),
                        Forms\Components\TextInput::make('precio_unitario')
                            ->required()
                            ->numeric(),
                        Forms\Components\TextInput::make('stock')
                            ->required()
                            ->numeric()
                            ->default(0),
                        Forms\Components\TextInput::make('ubicacion_almacen')
                            ->maxLength(200),
                        Select::make('id_categoria')
                            ->relationship('categoria', 'nombre')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nombre')
                                    ->required()
                                    ->maxLength(200),
                                Forms\Components\Textarea::make('descripcion')
                                    ->columnSpanFull(),
                            ])
                            ->required(),
                        // Forms\Components\TextInput::make('imagen'),
                        FileUpload::make('imagen')
                            ->image(),
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
                                    ->content(fn(Producto $record): ?string => $record->created_at?->diffForHumans()),

                                Placeholder::make('updated_at')
                                    ->label('Última modificación')
                                    ->content(fn(Producto $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->heading('Información del registro')
                            ->hidden(fn(?Producto $record) => $record === null)
                            ->columns(['xl' => 1, 'lg' => 2, 'md' => 2, 'sm' => 1])
                            ->columnSpan(['xl' => 1, 'lg' => 2, 'md' => 1, 'sm' => 1]),
                    ])
                    ->columns(['xl' => 1, 'lg' => 2, 'md' => 2, 'sm' => 1])
                    ->columnSpan(['xl' => 1, 'lg' => 2, 'md' => 1, 'sm' => 1]),
            ])->columns(['xl' => 4, 'lg' => 1, 'md' => 1, 'sm' => 1]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')
                    ->searchable(),
                Tables\Columns\TextColumn::make('precio_unitario')
                    ->prefix('S/. ')
                    ->numeric(decimalPlaces: 2, locale: 'en_US')
                    ->sortable(),
                Tables\Columns\TextColumn::make('stock')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ubicacion_almacen')
                    ->searchable(),
                Tables\Columns\TextColumn::make('categoria.nombre')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('imagen'),
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
