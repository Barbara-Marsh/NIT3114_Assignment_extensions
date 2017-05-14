<?php
/**
 * Created by PhpStorm.
 * User: Barbara
 * Date: 30/04/2017
 * Time: 10:50 AM
 */

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Plan;

class WelcomeComposer
{
    protected $plans;

    public function __construct()
    {
        $this->plans = Plan::all()->toArray();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('plans', $this->plans);
    }
}