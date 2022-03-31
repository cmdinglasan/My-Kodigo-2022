<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Location;
use App\Models\Position;
use App\Models\Candidate;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use App\Filament\Resources\CandidatesResource\Pages;
use App\Filament\Resources\CandidatesResource\RelationManagers;

class CandidatesResource extends Resource
{
    protected static ?string $model = Candidate::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Add Resources';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('position_id')
                    ->label('Position')
                    ->options(Position::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),
                Forms\Components\TextInput::make('entry_number')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('ballot_name')
                    ->required()
                    ->unique(),
                Forms\Components\Select::make('location_id')
                    ->label('Location')
                    ->options(Location::all()->pluck('location', 'id'))
                    ->required()
                    ->searchable()
                    ->getSearchResultsUsing(fn (string $query) => Location::where(['location', 'like', "%{$query}%"], ['province', 'like', "%{$query}%"], ['region', 'like', "%{$query}%"])->limit(50)->pluck('location', 'id')),
                Forms\Components\TextInput::make('partylist_code'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('position.name')
                    ->label('Position')
                    ->sortable(),
                Tables\Columns\TextColumn::make('entry_number')
                    ->label('Entry Number')
                    ->sortable(),
                Tables\Columns\TextColumn::make('ballot_name')
                    ->label('Ballot Name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('location.location')
                    ->label('Location')
                    ->sortable(),
                Tables\Columns\TextColumn::make('partylist_code')
                    ->label('Partylist')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\MultiSelectFilter::make('position')
                    ->options(Position::all()->pluck('name', 'id'))
                    ->column('position.name'),
                Tables\Filters\MultiSelectFilter::make('partylist')
                    ->options(Candidate::select('partylist_code')->distinct()->orderby('partylist_code', 'ASC')->pluck('partylist_code', 'partylist_code'))
                    ->column('partylist_code'),
                Tables\Filters\MultiSelectFilter::make('location')
                    ->options(Location::all()->pluck('location', 'id'))
                    ->column('location.location')
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
            'index' => Pages\ListCandidates::route('/'),
            'create' => Pages\CreateCandidates::route('/create'),
            'edit' => Pages\EditCandidates::route('/{record}/edit'),
        ];
    }

    // public static function getWidgets()
    // {
    //     return [
    //         'candidates' => [
    //             'title' => 'Candidates',
    //             'icon' => 'heroicon-o-collection',
    //             'route' => 'candidates.index',
    //             'count' => Candidate::count(),
    //         ],
    //     ];
    // }
}
