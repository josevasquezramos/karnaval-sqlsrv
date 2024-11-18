<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmpleadoResource\Pages;
use App\Filament\Resources\EmpleadoResource\RelationManagers;
use App\Models\Empleado;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class EmpleadoResource extends Resource
{
    protected static ?string $model = Empleado::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Core';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        Forms\Components\TextInput::make('dni')
                            ->required()
                            ->unique()
                            ->maxLength(8),
                        Forms\Components\TextInput::make('apellido_paterno')
                            ->required()
                            ->maxLength(50),
                        Forms\Components\TextInput::make('apellido_materno')
                            ->maxLength(50),
                        Forms\Components\TextInput::make('nombres')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('celular')
                            ->maxLength(15),
                        Forms\Components\DatePicker::make('fecha_nacimiento'),
                        Forms\Components\TextInput::make('direccion')
                            ->maxLength(200),
                        Forms\Components\TextInput::make('correo')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('usuario')
                            ->required()
                            ->maxLength(100),
                        Forms\Components\TextInput::make('clave')
                            ->password()
                            ->dehydrateStateUsing(fn($state) => Hash::make($state))
                            ->dehydrated(fn($state) => filled($state))
                            ->required(fn(string $context): bool => $context === 'create'),
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
                                    ->content(fn(Empleado $record): ?string => $record->created_at?->diffForHumans()),

                                Placeholder::make('updated_at')
                                    ->label('Última modificación')
                                    ->content(fn(Empleado $record): ?string => $record->updated_at?->diffForHumans()),
                            ])
                            ->heading('Información del registro')
                            ->hidden(fn(?Empleado $record) => $record === null)
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
                Tables\Columns\TextColumn::make('dni')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido_paterno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('apellido_materno')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nombres')
                    ->searchable(),
                Tables\Columns\TextColumn::make('celular')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fecha_nacimiento')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('direccion')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('correo')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('usuario')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListEmpleados::route('/'),
            'create' => Pages\CreateEmpleado::route('/create'),
            'edit' => Pages\EditEmpleado::route('/{record}/edit'),
        ];
    }
}
