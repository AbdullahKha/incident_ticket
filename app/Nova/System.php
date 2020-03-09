<?php

namespace App\Nova;

use App\User;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class System extends Resource
{

    public static function label()
    {
        return __('System');
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\System';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name_system';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [

            ID::make(__('IdSystem'),'id')->sortable(),
            Text::make(__('SystemName'),'name_system')->rules('required','max:255'),
            BelongsTo::make(__('CreatedBySystem'),'user',User::class),
            HasMany::make(__('Problem'),'problem',Problem::class),
            ID::make()->sortable(),
            Text::make('name_system'),
            BelongsTo::make('User'),
            HasMany::make('Problem'),

        ];

    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
    public static function indexQuery(NovaRequest $request, $query)
    {

        if (\Auth::user()->hasRole('Admin')) {
            return $query;
        }
            else{
                return false;
            }

    }
    public static function availableForNavigation(Request $request)
    {
        if (\Auth::user()->hasRole('Admin')) {
            return true;
        } else {
            return false;
        }    }

}
