<?php

namespace App\Http\Composers\Frontend;

use Illuminate\View\View;
use App\Models\Event;
use Carbon\Carbon;

/**
 * Class FeatureComposer.
 */
class UpcomingComposer
{
    

    /**
     * @param View $view
     *
     * @return bool|mixed
     */
    public function compose(View $view)
    {
        $date = date('m-d');
        // $featured_events = Event::inRandomOrder()->notExpired()->approved()->upcoming()->take(2)->get();
        // $upcoming_events = Event::whereRaw('DAYOFYEAR(curdate()) + 1 <= DAYOFYEAR(start_datetime) and start_datetime not like \'%-' . $date . '\'')
        //     ->limit(1)
        //     ->get();
        $upcoming_events  = "Works I guest";
        $upcoming_events = Event::whereDate('start_datetime', '>', Carbon::now()->toDateString())
                                            ->notExpired()->approved()->orderBy('start_datetime', 'asc')->take(1)->first();
        $view->with('upcoming_events', $upcoming_events);
    }
}
