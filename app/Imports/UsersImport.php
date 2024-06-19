<?php

namespace App\Imports;

use App\Models\Auth\User;
// use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;

// ini_set('max_execution_time', 180);
class UsersImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function collection(Collection $rows)
    {
        set_time_limit(0);
        foreach ($rows as $row) {
            User::create([
                'first_name' => $row[0],
                'last_name' => $row[1],
                'email' => $row[2],
                'password' => Hash::make('100liftolive'),
            ]);
        }
    }
    public function chunkSize(): int
    {
        return 250;
    }
}
