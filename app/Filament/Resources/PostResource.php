<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Articles';
    protected static ?string $modelLabel = 'Article';
    protected static ?string $pluralModelLabel = 'Articles';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Titre')
                ->required()
                ->live(onBlur: true)
                ->afterStateUpdated(fn($state, $set) => $set('slug', Str::slug($state))),
            Forms\Components\TextInput::make('slug')
                ->label('Slug')
                ->required()
                ->unique(ignoreRecord: true),
            Forms\Components\Textarea::make('excerpt')
                ->label('Résumé')
                ->columnSpanFull(),
            Forms\Components\RichEditor::make('content')
                ->label('Contenu')
                ->required()
                ->columnSpanFull(),
            Forms\Components\FileUpload::make('image')
                ->label('Image')
                ->image()
                ->columnSpanFull(),
            Forms\Components\TextInput::make('category')
                ->label('Catégorie'),
            Forms\Components\TagsInput::make('tags')
                ->label('Tags'),
            Forms\Components\Select::make('status')
                ->label('Statut')
                ->options([
                    'draft' => 'Brouillon',
                    'published' => 'Publié',
                ])
                ->default('draft')
                ->required(),
            Forms\Components\Toggle::make('featured')
                ->label('En vedette'),
            Forms\Components\DateTimePicker::make('published_at')
                ->label('Date de publication'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            Tables\Columns\ImageColumn::make('image')
                ->label('Image'),
            Tables\Columns\TextColumn::make('title')
                ->label('Titre')
                ->searchable(),
            Tables\Columns\TextColumn::make('category')
                ->label('Catégorie'),
            Tables\Columns\BadgeColumn::make('status')
                ->label('Statut')
                ->colors([
                    'warning' => 'draft',
                    'success' => 'published',
                ]),
            Tables\Columns\TextColumn::make('views')
                ->label('Vues')
                ->sortable(),
            Tables\Columns\TextColumn::make('published_at')
                ->label('Publié le')
                ->dateTime('d/m/Y')
                ->sortable(),
        ])
        ->filters([])
        ->actions([
            Tables\Actions\EditAction::make()->modalHeading('Modifier l\'article'),
            Tables\Actions\DeleteAction::make(),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
        ];
    }
}