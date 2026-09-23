<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-cpu-chip';

    protected static ?string $navigationGroup = 'Seções do Site';

    protected static ?string $navigationLabel = 'Serviços';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('order_num')
                    ->label('Número')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('Título do Serviço')
                    ->required(),
                Forms\Components\TextInput::make('category')
                    ->label('Categoria')
                    ->required(),
                Forms\Components\Textarea::make('description')
                    ->label('Descrição')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                Forms\Components\TagsInput::make('deliverables')
                    ->label('Entregáveis / Tecnologias (Cards)')
                    ->helperText('Pressione Enter ou vírgula após cada item para adicionar um novo card. Clique no "x" para remover.')
                    ->placeholder('Adicionar card (ex: Next.js)...')
                    ->separator(',')
                    ->splitKeys(['Tab', 'Enter', ','])
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Ativo no site')
                    ->required()
                    ->default(true),
                Forms\Components\TextInput::make('sort_order')
                    ->label('Ordem de Exibição')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order_num')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                Tables\Columns\TextColumn::make('sort_order')
                    ->numeric()
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
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
