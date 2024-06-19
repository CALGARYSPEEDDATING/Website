<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DateTime;

// use App\Models\Auth\User;

class UpdateUserBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:olduserdob';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Old Users Date of Birth';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $path = database_path('seeds/csv/gjnyhcqzqt2019-04-07usersoldonly1.csv');
        // $path = database_path('seeds/csv/calgary_speed_dating_usersdb.csv');

        $contactArr = $this->csvToArray($path);
        $collection = collect($contactArr);
        $contact = $collection->all();
  
        for ($i = 0; $i < count($contact); $i++) {
            if ($contact[$i]['dob'] > 0) {
                $dob = $this->changeDateFormat($contact[$i]['dob']);
            }
            // $dob = $this->changeDateFormat($contact[$i]['dob']);
            // $checkByEmail,
            \DB::table('users')->where('email', $contact[$i]['email'])->update([
                'dob' => $dob,
            ]);
        }
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

    public function changeDateFormat($date)
    {
        $time = DateTime::createFromFormat('m/d/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }
}
