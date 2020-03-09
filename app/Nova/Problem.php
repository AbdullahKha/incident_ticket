<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;
use mysql_xdevapi\Result;

class Problem extends Resource
{
    public static function label()
    {
        return __('Problem');
    }
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Problem';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

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
        logger(json_encode($request));
        return [
            ID::make(__('IdProblem'),'id')->sortable(),
            Text::make(__('Title'),'title') ->rules('required', 'max:255'),
            DateTime::make(__('DateTime'),'dateTime_problem')->showOnDetail()->rules('required'),
            Trix::make(__('ReasonProblem'),'reason_problem') ->rules('required'),
            Trix::make(__('ScenarioProblem'),'scenario_problem')->rules('required'),
            Trix::make(__('LongTermSolution'),'longTerm_solution'),
            Trix::make(__('ShortTermSolution'),'shortTerm_solution'),
            Select::make(__('LevelsProblem'),'levels_problem')->options([
                'عالي'=>__('High'),
                'متوسط'=>__('Medium'),
                'ضعيف'=>__('low'),
            ]) ->rules('required')->hideWhenUpdating(),
            BelongsTo::make(__('CreatedBy'),'user',User::class)->exceptOnForms(),
            BelongsTo::make(__('SolvedBy'),'solve',User::class)->exceptOnForms()->showOnUpdating(),
            BelongsTo::make(__('SystemName'),'system',System::class),
            BelongsTo::make(__('TypeProblem'),'typeProblem',TypeProblem::class),
            ID::make()->sortable(),
            Text::make('title'),
            DateTime::make('Date','dateTime_problem')->showOnDetail(),
            Trix::make('Reasons','reason_problem'),
            Trix::make('Scenario','scenario_problem'),
            Trix::make('Long Term','longTerm_solution'),
            Trix::make('Short Term','shortTerm_solution'),
            Select::make('Levels pf Problem','levels_problem')->options([
                'high'=>'High',
                'medium'=>'Medium',
                'low'=>'low',
            ])->hideWhenUpdating(),
            BelongsTo::make('User','user')->exceptOnForms(),
            BelongsTo::make('User','solve')->exceptOnForms()->showOnUpdating()->hideFromDetail(),
            BelongsTo::make('System'),
            BelongsTo::make('TypeProblem'),
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
            return $query->where('created_by_user_id', \Auth::user()->id);
    }

    }
}
