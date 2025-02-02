<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Faker\Core\File;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconPosition;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?string $navigationGroup = 'Books & Categories';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->label('Title')
                    ->required()
                    ->maxLength(255),

                TextInput::make('author')
                    ->label('Author')
                    ->required()
                    ->maxLength(255),

                TextInput::make('genre')
                    ->label('Genre')
                    ->required()
                    ->maxLength(100),

                TextInput::make('publisher')
                    ->label('Publisher')
                    ->required()
                    ->maxLength(255),

                TextInput::make('number_of_pages')
                    ->label('Number of Pages')
                    ->numeric()
                    ->required()
                    ->minValue(1),

                TextInput::make('language')
                    ->label('Language')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('published_year')
                    ->label('Published Year')
                    ->required()
                    ->format('Y')
                    ->maxDate(now()),

                TextInput::make('isbn')
                    ->label('ISBN')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20),


                FileUpload::make('cover_image')
                    ->label('Cover Image')
                    ->directory('book-covers')
                    ->image()
                    ->maxSize(2048)
                    ->nullable(),

                    RichEditor::make('synopsis')
                    ->label('Synopsis')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('author')
                    ->label('Author')
                    ->searchable(),

                TextColumn::make('genre')
                    ->label('Genre')
                    ->searchable(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->color('gray')
                    ->label('View Detail')
                    ->iconPosition(IconPosition::After),
                Tables\Actions\EditAction::make()
                    ->color('warning')
                    ->label('Edit')
                    ->iconPosition(IconPosition::After),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->filters([])
            ->defaultSort('title', 'asc'); // Default urutkan berdasarkan judul buku (A-Z)
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
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}
