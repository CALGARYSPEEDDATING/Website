<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->truncate();
        $json = File::get("database/data/tags.json");
        $data = json_decode($json);
        foreach ($data as $obj) {
            DB::table('tags')->insert(array(
                'name' => $obj->name,
                ));
        }
    }
}
