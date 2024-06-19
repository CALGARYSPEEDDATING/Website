<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Auth\User;

class OldUsersSeeder extends Seeder
{
    use DisableForeignKeys;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->disableForeignKeys();
        
        // Sub Users
        $path = database_path('seeds/csv/new_users.csv');
        // Non Sub USers


        
        $contactArr = $this->csvToArray($path);
        $collection = collect($contactArr);
        // $contact = $collection->all();
        $contact = $collection->all();

        foreach($contact as $k => $v) 
        {
            $cona[] = $v['e-Mail'];
        }
        $user = User::whereIn('email', $cona)->get();
        $pro = array();
        // $profile = \DB::table('dating_profiles')->update(['subscribed' => 1]);
        foreach ($user as $u) {
            $pro[] = $u->id; 
            $profile = \DB::table('dating_profiles')
            ->whereIn('user_id', $pro)
            ->update(['subscribed' => 0]);
        }

        // dd($profile);
        // $cona = array();
        // foreach ($contact as $k => $v)
        // {
        //     $cona[] = $v['e-Mail'];
        // }
        // $user = User::whereIn('email', $cona)->get();
        // $user->profile()->update([
        //             'subscribed' => 1,
        //         ]);
        // dd($user);
        // for ($i = 0; $i < count($contact); $i++) {
        //     if ($contact[$i]['dob'] > 0) {
        //         // $dob = $this->changeDateFormat($contact[$i]['dob']);
        //         $dob = $contact[$i]['dob'];
        //     }
        //     // $dob = self::changeDateFormat($contact[$i]['dob']);
        //     $user = User::firstOrCreate([
        //         'first_name'        => $contact[$i]['first_name'],
        //         'last_name'         => $contact[$i]['last_name'],
        //         'email'             => $contact[$i]['email'],
        //         'confirmation_code' => md5(uniqid(mt_rand(), true)),
        //         'active'            => 1,
        //         'password'          => Hash::make('DW0$Qu5?i6Di'),
        //         // 'dob'               => $contact[$i]['dob'],
        //         'dob'               => $dob,
        //         'phone'             => $contact[$i]['phone'],
        //         'confirmed'         => 1,
        //         'active'            => $contact[$i]['archived'] == 'no' ? 1 : 0,
        //     ]);
        //     if ($user) {
        //         $user->profile()->create([
        //                             'gender'        => $contact[$i]['gender'] == 'Female' ? 1 : 0,
        //                             'a_phone'       => $contact[$i]['a_phone'],
        //                             'matches_info'  => $contact[$i]['contact_info'],
        //                             'about_us'      => $contact[$i]['heard_about'],
        //                             'profile'       => $contact[$i]['profile'],
        //                             'newsletter'    => $contact[$i]['newsletter'] == 'yes' ? 1 : 0,
        //                             'subscribed'    => $contact[$i]['subscribed'] == 'yes' ? 1 : 0
        //                         ]);
        
        //         $user->assignRole(config('access.users.default_role'));
        //     }
        // }
        $this->enableForeignKeys();
    }

    public function changeDateFormatOld($date)
    {
        $time = \DateTime::createFromFormat('m/d/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
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
}
