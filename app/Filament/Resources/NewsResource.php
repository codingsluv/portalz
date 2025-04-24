<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Data Master';
    protected static ?string $navigationLabel = 'News';
    protected static ?string $label = 'News';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('author_id')
                    ->relationship('author', 'name')
                    ->label('Author')
                    ->required(),
                Forms\Components\Select::make('news_category_id')
                    ->relationship('newsCategory', 'name')
                    ->label('News Category')
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),
                Forms\Components\TextInput::make('slug')
                    ->readOnly(),
                Forms\Components\FileUpload::make('thumbnail')
                    ->label('Thumbnail')
                    ->image()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->label('Content')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Toggle::make('is_featured')
                    ->label('Is Featured')
                    ->default(false)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('author.name')
                    ->label('Author')
                    ->sortable(),
                Tables\Columns\TextColumn::make('newsCategory.name')
                    ->label('Category')
                    ->sortable(),
                Tables\Columns\TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('thumbnail')
                    ->label('Thumbnail')
                    ->size(50)
                    ->default('https://ui-avatars.com/api/?name=News&background=random')
                    ->sortable(),
                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Is Featured'),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('author_id')
                    ->relationship('author', 'name')
                    ->label('Select Author'),
                Tables\Filters\SelectFilter::make('news_category_id')
                    ->relationship('newsCategory', 'name')
                    ->label('Select Category'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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
            'index' => Pages\ListNews::route('/'),
            // 'create' => Pages\CreateNews::route('/create'),
            // 'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }
}
