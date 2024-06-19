<?php

namespace App\Http\Composers\Frontend;

use Illuminate\View\View;
use App\Repositories\Backend\Auth\UserRepository;
use App\Models\Event;
use Carbon\Carbon;

/**
 * Class FeatureComposer.
 */
class FeatureComposer
{
    

    /**
     * @param View $view
     *
     * @return bool|mixed
     */
    public function compose(View $view)
    {
        $featured_events = Event::whereDate('start_datetime', '>', Carbon::now()->toDateString())->notExpired()->approved()->upcoming()->take(2)->get();
        // Event::
        // ->notExpired()->approved()->orderBy('start_datetime', 'asc')->take(1)
        $view->with('feature_events', $featured_events);
    }
}
