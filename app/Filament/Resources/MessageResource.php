<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MessageResource\Pages;
use App\Models\Message;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MessageResource extends Resource
{
    protected static ?string $model = Message::class;
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationLabel = 'Messages';
    protected static ?string $modelLabel = 'Message';
    protected static ?string $pluralModelLabel = 'Messages';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('name')
                ->label('Nom')
                ->required(),
            Forms\Components\TextInput::make('email')
                ->label('Email')
                ->email()
                ->required(),
            Forms\Components\TextInput::make('phone')
                ->label('Téléphone'),
            Forms\Components\TextInput::make('subject')
                ->label('Sujet'),
            Forms\Components\Textarea::make('message')
                ->label('Message')
                ->required()
                ->columnSpanFull(),
            Forms\Components\Toggle::make('read')
                ->label('Lu'),
            Forms\Components\DateTimePicker::make('read_at')
                ->label('Lu le'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nom')
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->label('Email')
                ->searchable(),
            Tables\Columns\TextColumn::make('subject')
                ->label('Sujet'),
            Tables\Columns\IconColumn::make('read')
                ->label('Lu')
                ->boolean(),
            Tables\Columns\TextColumn::make('created_at')
                ->label('Reçu le')
                ->dateTime('d/m/Y H:i')
                ->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\ViewAction::make()->modalHeading('Voir le message'),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
        ];
    }
}