<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RemoveNoDateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:user_no_dob';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove users where dob empty';

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
        \Schema::disableForeignKeyConstraints();
        \DB::table('users')->where('dob', '=', '')->delete();
        \Schema::enableForeignKeyConstraints();
    }
}
