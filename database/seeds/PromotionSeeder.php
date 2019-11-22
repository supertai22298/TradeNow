<?php

use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //test data for 10 promotion programmes
        $i=1;
        while($i <=10){
            DB::table('promotions')->insert([
                'type'=>"type - ".$i,
                'code'=>"PROMOTION-".$i,
                'title'=>"Program - ".$i,
                'description'=>"save more money".$i,
                'reduction_level'=>"  reduction level :".$i,
                'banner'=>"banner for Program ".$i,
                'banner_thumbnail'=>"banner thubnail ",
                'started_at'=>NOW(),
                'finished_at'=>NOW()
            ]);
            $i++;
        }
        
    }
}
