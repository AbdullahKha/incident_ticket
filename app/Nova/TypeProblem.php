<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class TypeProblem extends Resource
{

    public static function label()
    {
        return __('TypeProblem');
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\TypeProblem';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'type_problem';

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
            ID::make(__('Number'),'id')->sortable(),
            Text::make(__('TypeProblem'),'type_problem')->rules('required','max:255'),
            BelongsTo::make(__('CreatedByTypeProblem'),'user',User::class),
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
        } else {
           return null;
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
