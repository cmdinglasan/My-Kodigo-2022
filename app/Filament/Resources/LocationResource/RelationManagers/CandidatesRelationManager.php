<?php

namespace App\Filament\Resources\LocationResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\Location;
use App\Models\Position;
use App\Models\Candidate;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class CandidatesRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'candidates';

    protected static ?string $recordTitleAttribute = 'title';

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
                    ->required(),
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
                    ->column('partylist_code')
            ]);
    }
}
