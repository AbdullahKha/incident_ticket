<?php

namespace Laravel\Nova\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Laravel\Nova\Nova;

class NovaExceptionHandler extends ExceptionHandler
{
    /**
     * Report or log an exception.
     *
     * @param  \Exception  $e
     * @return mixed
     *
     * @throws \Exception
     */
    public function report(\Exception $e)
    {
        return with(Nova::$reportCallback, function ($handler) use ($e) {
            if (is_callable($handler) || $handler instanceof Closure) {
                return call_user_func($handler, $e);
            }

            return parent::report($e);
        });
    }
}
