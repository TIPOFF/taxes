<?php

namespace Database\Seeders\Production;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TaxesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        DB::table('taxes')->delete();

        DB::table('taxes')->insert(array(
            0 =>
            array(
                'applies_to' => 'booking',
                'created_at' => '2020-05-08 12:35:15',
                'creator_id' => 1,
                'id' => 1,
                'name' => '0% State & Local',
                'percent' => '0.00',
                'slug' => 'zero',
                'title' => 'No Taxes',
                'updated_at' => '2020-05-08 12:35:15',
            ),
            1 =>
            array(
                'applies_to' => 'booking',
                'created_at' => '2020-09-28 18:25:02',
                'creator_id' => 1,
                'id' => 2,
                'name' => 'Jacksonville 7%',
                'percent' => '7.00',
                'slug' => 'jax-7',
                'title' => 'Jacksonville',
                'updated_at' => '2020-09-28 18:25:02',
            ),
            2 =>
            array(
                'applies_to' => 'booking',
                'created_at' => '2020-10-01 22:20:45',
                'creator_id' => 1,
                'id' => 3,
                'name' => 'Orlando 6.5%',
                'percent' => '6.50',
                'slug' => 'orl-6-5',
                'title' => 'Orlando',
                'updated_at' => '2020-10-01 22:20:45',
            ),
            3 =>
            array(
                'applies_to' => 'booking',
                'created_at' => '2020-10-07 16:24:08',
                'creator_id' => 1,
                'id' => 4,
                'name' => 'Chicago 9%',
                'percent' => '9.00',
                'slug' => 'chi-9',
                'title' => 'Chicago',
                'updated_at' => '2020-10-07 16:24:08',
            ),
            4 =>
            array(
                'applies_to' => 'booking',
                'created_at' => '2020-10-13 14:32:57',
                'creator_id' => 1,
                'id' => 5,
                'name' => 'Akron 0%',
                'percent' => '0.00',
                'slug' => 'akron-0',
                'title' => 'Akron 0%',
                'updated_at' => '2020-10-13 14:32:57',
            ),
            5 =>
            array(
                'applies_to' => 'booking',
                'created_at' => '2020-10-13 14:33:56',
                'creator_id' => 1,
                'id' => 6,
                'name' => 'Tampa 8.5%',
                'percent' => '8.50',
                'slug' => 'tampa-8-5',
                'title' => 'Tampa 8.5%',
                'updated_at' => '2020-10-13 14:33:56',
            ),
            6 =>
            array(
                'applies_to' => 'booking',
                'created_at' => '2020-10-13 14:51:51',
                'creator_id' => 1,
                'id' => 7,
                'name' => 'Grand Rapids 0%',
                'percent' => '0.00',
                'slug' => 'grand-rapids-0',
                'title' => 'Grand Rapids 0%',
                'updated_at' => '2020-10-13 14:51:51',
            ),
        ));
    }
}
