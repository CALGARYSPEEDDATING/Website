<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use Excel;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Hash;
use App\Models\Auth\User;
use App\Mail\Frontend\UserRegisterEmail;
use App\Models\DatingProfile;
use Carbon\Carbon;
use Mail;
use Illuminate\Support\Facades\Artisan;
use DateTime;

class SearchController extends Controller
{
    public function testEmail()
    {
        // $users = User::role(['user'])->active()->pluck('id', 'first_name', 'last_name')->all();

        $users = User::all()->pluck('full_name', 'id');
        $users = \DB::table('users')->select(
            'id',
            'first_name',
            'last_name'
        )->get();
        $data = [];
        foreach ($users as $use) {
            $data[] = array(
                "id"=>$use->id,
                "text"=>$use->first_name.' '.$use->last_name);
        }
        return response()->json($data);
        // dd($data['id']);

        // $user = User::where('id', 2)->first();
        // $event = Event::where('id', 1)->first();
   
        // // return new ConfirmVolunteer($event);
        // return (new UserRegisterEmail($user, $event))->render();
    }
    public function changeDateFormat($date)
    {
        // $time = DateTime::createFromFormat('m/d/Y', $date);
        $time = DateTime::createFromFormat('F j, Y', $date);
        $ctime = '';
        if ($time) {
            $ctime = $time->format('Y-m-d H:i:s');
        } else {
            $today = date("F j, Y");
            $day = DateTime::createFromFormat('F j, Y', $today);
            $ctime = $day->format('Y-m-d H:i:s');
        }
        return $ctime;
    }

    public function addUserByCSV() {
        // $path = database_path('seeds/csv/new_removed_users.csv');
        $path = database_path('seeds/csv/new_removed_users_test.csv');

        $contactArr = $this->csvToArray($path);
        $collection = collect($contactArr);
        $contact = $collection->all();
        // dd($contact);
        $cona = array();
        foreach ($contact as $k => $v) {
            if ($v['Email'] != "" && !empty($v['Email'])) {
                // $cona[] = $v['Email'];
                $stripeEmail = explode(';', $v['Email']);
                foreach ($stripeEmail as $email) {
                    $cona[] = str_replace(' ', '', $email);
                }
            }
            if ($v['Birthdate'] != "" && !empty($v['Birthdate'])) {
                // $cona[] =  $this->changeDateFormat($v['Birthdate']);
                // $cov = DateTime::createFromFormat('F j, Y', $v['Birthdate']);
                // if ($cov) {
                //     $cona[] =  $cov;
                //     $cona[] = $v['Birthdate'];
                // }
            }
            // else {
            //     $cona[] = $dob = date("F j, Y");
            // }
        }
       
        // $user = User::whereIn('email', $cona)->get();
        // dd($user);
        // $pro = array();

        // $user = User::get();
        // foreach ($user as $u) {
           
        //     dd($u->id);
        //     $profile = \DB::table('dating_profiles')
        //     ->whereIn('user_id', $pro)
        //     ->update(['subscribed' => 0]);
        // }
       
        // $user = User::whereIn('email', $cona)->get();


        for ($i = 0; $i < count($contact); $i++) {

            if ($contact[$i]['Birthdate'] != "" && !empty($contact[$i]['Birthdate'])) {
                $dob = $this->changeDateFormat($contact[$i]['Birthdate']);
            } else {
                $date = date("F j, Y");
                $dob = $this->changeDateFormat($date);
            }
            if ($contact[$i]['Email']!= "" && !empty($contact[$i]['Email'])) {
                // $cona[] = $v['Email'];
                $stripeEmail = explode(';', $contact[$i]['Email']);
                foreach ($stripeEmail as $email) {
                    $uemail = str_replace(' ', '', $email);
                }
            } else {
                    $uemail = 'nomail@calgaryspeeddating.com';
            }
            
            $user = User::firstOrCreate(
                [
                'email' => $uemail
                ],
                [
                'first_name'        => $contact[$i]['First Name'],
                'last_name'         => $contact[$i]['Last Name'],
                'email'             => $uemail,
                'confirmation_code' => md5(uniqid(mt_rand(), true)),
                'active'            => 1,
                'password'          => Hash::make('DW0$Qu5?i6Di'),
                'dob'               => $dob,
                'phone'             => $contact[$i]['Cell'] ? $contact[$i]['Cell'] : $contact[$i]['home'],
                'confirmed'         => 1,
                'active'            => 1,
                ]
            );
            if ($user) {
                $user->profile()->create([
                                    'gender'        => $contact[$i]['sex'] == 'F' ? 1 : 0,
                                    'a_phone'       => $contact[$i]['home'],
                                    'matches_info'  => $contact[$i]['Contact Info'],
                                    'about_us'      => $contact[$i]['Heard'],
                                    'profile'       => $contact[$i]['Profile'],
                                    'newsletter'    => 0,
                                    'subscribed'    =>  0,
                                    'pass_events'    => $contact[$i]['Events']
                                ]);
            }
            $user->assignRole(config('access.users.default_role'));
        }
        return 'Works';
        // else {
            // $user->profile()->update([
                //                         'gender'        => $contact[$i]['sex] == 'F' ? 1 : 0,
                //                         'a_phone'       => $contact[$i]['Phone'],
                //                         'matches_info'  => $contact[$i]['Email_Phone''],
                //                         'about_us'      => $contact[$i]['heard_about'],
                //                         'profile'       => $contact[$i]['Profile'],
                //                         'newsletter'    => $contact[$i]['newsletter'] == 1,
                //                         'subscribed'    => $contact[$i]['subscribed'] == 1
                //                     ]);
        // }
         // $profile = \DB::table('dating_profiles')->update(['subscribed' => 1]);
        // foreach ($user as $u) {
        //     $pro[] = $u->id; 
        //     $profile = \DB::table('dating_profiles')
        //     ->whereIn('user_id', $pro)
        //     ->update(['subscribed' => 0]);
        // }

        // dd($profile);
        // $cona = array();
        // foreach ($contact as $k => $v)
        // {
        //     $cona[] = $v['e-Mail'];
        // }
    }
    
    // End CSV Testing
    public function csv(User $user, DatingProfile $profile)
    {

         // Update Users
        //  Convert Old Users
        // $path = database_path('seeds/csv/gjnyhcqzqt2019-04-07usersoldonly.csv');
        // End Convert Old Users
  

        $path = database_path('seeds/csv/new_users.csv');
        $contactArr = $this->csvToArray($path);
        $collection = collect($contactArr);
        $contact = $collection->all();
        dd($contact);
        $cona = array();
        foreach($contact as $k => $v) 
        {
            $cona[] = $v['e-Mail'];
        }
        $user = User::whereIn('email', $cona)->get();
        $pro = array();
        foreach ($user as $u) {
            $pro[] = $u->id; 
            $profile = \DB::table('dating_profiles')
            ->whereIn('user_id', $pro)->get();    
            // ->update(['active' => true]);
        }

        dd($profile);
        for ($i = 0; $i < count($contact); $i++) {
            // if ($contact[$i]['e-Mail'] > 0) {
            //     // dd($contact[$i]['dob']);
            //     // $dob[] = $contact[$i]['dob'];
            //     $dob[] = $contact[$i]['uuid'];
            //     // $dob[] = $this->changeDateFormat($contact[$i]['dob']);
            // }
            $cona = array();
            $user = User::where('email', $contact[$i]['e-Mail'])->get();
            $cona['email'] = $contact[$i]['e-Mail'];
            dd($user);
        }
        // dd($dob);
        // $minAge = 36 - 2;
        // $maxAge = 45 + 2;
        
        // $minDate = Carbon::today()->subYears($minAge)->format('m/d/Y');
        // $maxDate = Carbon::today()->subYears($maxAge)->endOfDay()->format('m/d/Y');

        // $minDate = Carbon::today()->subYears($maxAge)->format('m/d/Y h:i:s'); // make sure to use Carbon\Carbon in the class
        // $maxDate = Carbon::today()->subYears($minAge)->format('m/d/Y h:i:s');
        $minAge = 18 - 2;
        $maxAge = 25 + 2;
        $minDate = Carbon::today()->subYears($maxAge)->format('Y-m-d');
        $maxDate = Carbon::today()->subYears($minAge)->format('Y-m-d');
        $db_users = User::all();
        dd($db_users);
        $users = User::role(['user'])->whereBetween('dob', [$minDate, $maxDate])->whereHas('profile', function ($q) {
            $q->where('gender', 0);
        })->get();
        // dd($users);
        //->take(10)
        // ->inRandomOrder()->take(10)
        // $now = Carbon::now();  Doesn't work
        // $start = $now->subYears($minAge)->format('m/d/Y h:i:s');
        // $end = $now->subYears($maxAge)->format('m/d/Y h:i:s');
        
        // $end = $now->subYears($maxAge)->endOfDay()->format('m/d/Y');
        // dd($start);
        // dd($maxDate);
        // dd($minDate);
        // $users = User::role(['user'])->whereBetween('dob', [$minDate, $maxDate])->whereHas('profile', function ($q) {
        //     $q->where('gender', 1);
        // })->take(10)->get();
        // dd($maxDate);
        $today = Carbon::now();
        //$today = Carbon::createFromDate(2017, 7, 2);//to make manually
        $sub35 = $today->subYears(35);
        // $minDate = Carbon::today()->subYears($maxAge);
        // // '12/31/1974 00:00:00'
        // $users = User::whereDate('dob', '>', $start)->get();
        // DB::raw("TRIM(userid)")
        // $users = User::role(['user'])->whereBetween('dob', [$minDate, $maxDate])->get();
        // $users = User::role(['user'])->whereBetween('dob', [$minDate, $maxDate])->get();
        
        // $users = User::role(['user'])->whereBetween('dob', ['07/13/1987', '09/05/1971 '])->get();
        // dd($users);
        // $users = User::role(['user'])->take(10)->get();
        // dd($minDate);
        // $users =  User::where('dob', '>=', $minDate)->where('dob', '<=', $minDate)->get();
        // $users =  User::whereRaw('dob <> ""')->where('dob', '>=', '12/27/1978 00:00:00')->inRandomOrder()->take(10)->get();

        // $q->whereBetween(DB::raw('TIMESTAMPDIFF(YEAR,users.date_of_birth,CURDATE())'),array(Input::get('age_from'),Input::get('age_to')));
        
        // $users =  User::whereRaw('dob <> ""')->where('dob', '<=', '12/31/1970')->inRandomOrder()->take(10)->get();
        $u =  \DB::table('users')->whereBetween(\DB::raw('TIMESTAMPDIFF(YEAR, users.dob,CURDATE())'), array(55 ,45))->get();
        // $u = \DB::table('users')
        // ->select(\DB::raw('floor(DATEDIFF(CURDATE(), dob) /365) as age'))
        // ->where('age', '>', 35)
        // ->get();
        dd($u);
        // 03/06/1972 00:00:00 min
        // "03/06/1985 12:00:00" max
        foreach ($users as $user) {
            dd(trim($user->dob));
        }
        
        // $user->setRelations([]);
        // $user = $user->load('profile');
        $users = $user->role(['user'])->active()->with(['profile' => function ($query) {
            $query->where('newsletter', 1);
        }])->get();


        $users = $user->role(['user'])->active()->get();
        
        // $some = DatingProfile::where('gender', 0)->with(['user' => function ($query) {
        //     $query->where('first_name', '=', 'Jorge');
        // }])->get();
       
        $some = DatingProfile::with(['user'])->where('gender', 1)->get();
        
        foreach ($some as $use) {
            $me = [];
            // dd($use->user);
            foreach ($use->user->where('first_name', '=', 'Ryan')->get() as $g) {
                $me[] = $g;
            }
            dd($me);
        }
        
        
        

        // $test = $profile->load(['user' => function ($q) use (&$user) {
        //     $user = $q->get();
        // }]);
        // dd($test);
        // dd($some->user());
        
        // $users = User::role(['user'])->active()->where('newsletter', 1)->get();
       
        // $path = database_path('seeds/csv/calgary_speed_dating_users100.csv');
        // $path = database_path('seeds/csv/calgary_speed_dating_usersdb.csv');
        // $data = array_map('str_getcsv', file($path));
        // // dd($data);
        // //loop over the data
        // $at = [];
        // foreach ($data as $row) {
        //     $at[] = $row[0];
        //     //insert the record or update if the email already exists
        // }
        // dd($at);
        // set_time_limit(0);
        // $file = public_path('file/test.csv');
        // Hash::make()
      
        // $contactArr = $this->csvToArray($path);
        // $collection = collect($contactArr);
 
        // $five = $collection->chunk(2);
        // $contact = $five->toArray();
        // $contact = $collection->all();
        // dd($collection->where('gender', 'female'));
        // dd($contact);
        // $data = [];
        // dump($five);
        // dump($collection->firstWhere('first_name', 'Ana'));
        // Use When all collections
        // $five->each(function ($contact, $key) {
        //     // dd($contact);
        //     // DB::table('users')->insert($data);

        //     $user = User::firstOrCreate([
        //         'first_name'        => $contact['first_name'],
        //         'last_name'         => $contact['last_name'],
        //         'email'             => $contact['email'],
        //         'confirmation_code' => md5(uniqid(mt_rand(), true)),
        //         'active'            => 1,
        //         'password'          => Hash::make('testing'),
        //         'dob'               => $contact['dob'],
        //         'phone'             => $contact['phone'],
        //         'confirmed'         => 1,
        //         'active'            => $contact['archived'] == 'no' ? 1 : 0,
        //         // 'last_login_at'     => $contact['last_login'],
        //         // 'created_at'        => $contact['created_on'],
        //         // 'updated_at'        => $contact['updated_on'],
        //     ]);
        //     if ($user) {
        //         $user->profile()->create([
        //                     'gender'        => $contact['gender'] == 'female' ? 1 : 0,
        //                     'a_phone'       => $contact['a_phone'],
        //                     'matches_info'  => $contact['contact_info'],
        //                     'about_us'      => $contact['heard_about'],
        //                     'newsletter'    => $contact['newsletter'] == 'Yes' ? 1 : 0,
        //                     'subscribed'    => $contact['subscribed'] == 'Yes' ? 1 : 0
        //                 ]);

        //         $user->assignRole(config('access.users.default_role'));
        //     }
           
            
        //     // if ($user) {
        //     //     // Store users profiles
        //     //     $user->profile()->create([
        //     //         'gender'        => $data['gender'],
        //     //         'a_phone'       => $data['a_phone'],
        //     //         'matches_info'  => $data['matches_contact'],
        //     //         'about_us'      => $data['heard_about_us'],
        //     //     ]);
        //     //     /*
        //     //         * Add the default site role to the new user
        //     //         */
        //     //
               
        //     //
        //     return back()->withFlashSuccess('Hello');
        // });
        
        // for ($i = 0; $i < count($contact); $i++) {
        //     // dd($contact[$i]);
        //     $user = User::firstOrCreate([
        //         'first_name'        => $contact[$i]['first_name'],
        //         'last_name'         => $contact[$i]['last_name'],
        //         'email'             => $contact[$i]['email'],
        //         'confirmation_code' => md5(uniqid(mt_rand(), true)),
        //         'active'            => 1,
        //         'password'          => Hash::make('testing'),
        //         'dob'               => $contact[$i]['dob'],
        //         'phone'             => $contact[$i]['phone'],
        //         'confirmed'         => 1,
        //         'active'            => $contact[$i]['archived'] == 'no' ? 1 : 0,
        //         // 'last_login_at'     => $contact[$i]['last_login'],
        //         // 'created_at'        => $contact[$i]['created_on'],
        //         // 'updated_at'        => $contact[$i]['updated_on'],
        //     ]);
        //     if ($user) {
        //         $user->profile()->create([
        //                             'gender'        => $contact[$i]['gender'] == 'female' ? 1 : 0,
        //                             'a_phone'       => $contact[$i]['a_phone'],
        //                             'matches_info'  => $contact[$i]['contact_info'],
        //                             'about_us'      => $contact[$i]['heard_about'],
        //                             'newsletter'    => $contact[$i]['newsletter'] == 'Yes' ? 1 : 0,
        //                             'subscribed'    => $contact[$i]['subscribed'] == 'Yes' ? 1 : 0
        //                         ]);
        
        //         $user->assignRole(config('access.users.default_role'));
        //     }
        // }

        
        // DB::table('users')->insert($data);

        // start quick test
        // $at = [];
      
        // if (($handle = fopen($path, 'r')) !== false) {
        //     while (($data = fgetcsv($handle, 1000, ',')) !== false) {
        //         $at[] = $data[0];
        //     }
        //     fclose($handle);
        // }
        // dd($at);
        // ENd quick test

        // $handle = fopen($path, 'r');
        // if ($handle) {
        //     while ($row = fgetcsv($handle) !== false) {
        //         // Process this line and save to database
        //         // var_dump($row);
        //         echo $row;
        //     }
        // }
        // $path = database_path('seeds/csv/calgary_speed_dating_users.csv');
        // $data = Excel::import(new UsersImport, $path);
        // $data = Excel::load($path, function ($reader) {
        // })->get();
       
        // Excel::filter('chunk')->load(database_path('seeds/csv/calgary_speed_dating_users.csv'))->chunk(250, function ($results) {
        //     // foreach ($results as $row) {
        //     //     $user = User::create([
        //     //         'username' => $row->username,
        //     //         // other fields
        //     //     ]);
        //     // }
        //     dd($results);
        // });
        // dd('works');
        // Update Users
        // $path = database_path('seeds/csv/calgary_speed_dating_usersdb.csv');
        // $contactArr = $this->csvToArray($path);
        // $collection = collect($contactArr);
        // $contact = $collection->all();
  
        // for ($i = 0; $i < count($contact); $i++) {
        //     if ($contact[$i]['dob'] > 0) {
        //         $dob[] = $this->changeDateFormat($contact[$i]['dob']);
        //     }
        // }
        // dd($dob);
        // // Artisan::call('remove:user_no_dob');
        // dd('Works');
        // $u =  \DB::table('users')->where('dob', '=', '')->get();
        // dd($u);
    }
    



    public function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 5000, $delimiter)) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }


    public function index(Request $request, Event $event)
    {
        $events_q =  $event->newQuery();
        $query = array();
        // Keyword search
        if ($request->has('keywords')) {
            $query['keywords'] = $request->input('keywords');
            $events_q->where('title', 'LIKE', '%'.$request->input('keywords').'%');
        }

        if ($request->has('type')) {
            $query['type'] = $request->input('type');
            $events_q->where('type', '=', $query['type']);
            
            // $jobs->where('status', 'LIKE', '%'.$request->input('type').'%');
        }

        if ($request->has('status')) {
            $query['status'] = $request->input('status');
            $events_q->where('status', '=', $request->input('status'));
            
            // $jobs->where('status', 'LIKE', '%'.$request->input('type').'%');
        }

        if ($request->has('time_period')) {
            $query['time_period'] = $request->input('time_period');
            $today = Carbon::today()->toDateString();
            if ($request->input('time_period') == 'today') {
                $events_q->where('start_time', '=', $today);
            }
            if ($request->input('time_period') == 'past') {
                $events_q->where('start_time', '<', $today);
            }
            if ($request->input('time_period') == 'upcoming') {
                $events_q->where('start_time', '>', $today);
            }
            // $events_q->where('status', '=', $request->input('status'));
            
            // $jobs->where('status', 'LIKE', '%'.$request->input('type').'%');
        }

        if ($request->has('date_posted')) {
            $posted_options = explode('|', $request->input('date_posted'));
            $query['date_posted'] = $posted_options[0];
            $events_q->whereDate('created_at', '>=', $posted_options[0]);
        }



        
        $events = Event::orderBy('id', 'desc')->paginate(2, ['*'], 'results');
        // $results = $events_q->paginate(2)->chunk(100);
        $results = $events_q->paginate(200);
        // $results->appends([$request->except('page')]);
        // dd($results);
        $message = 'Sorry, no event matched your criteria.';
        if (count($results) > 0) {
            return view('backend.event.manage', compact('results', 'events', 'query'));
        } else {
            // return view('website.jobseekers.search')->withMessage($message)->with($data);
            return view('backend.event.manage', compact('message', 'events', 'query'));
        }
    }
}
