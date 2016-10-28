<?php

use Illuminate\Database\Seeder;

class TimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //


        for($i=0;$i<10;$i++){
            \App\Model\Timers::create(['year'=>2010+$i,
                'date'=> date('Y-m-d H:m:s'),
                'address'=>'广州'.$i,
                'title'=>'标题'.$i,
                'content'=>'内容'.$i,
                'authorId'=>$i

                ]);
        }
    }
}
