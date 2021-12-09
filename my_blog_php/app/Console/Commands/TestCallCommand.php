<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class TestCallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:callCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '测试调用命令';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $code = '002008';
        $start = '2018-12-03';
        $end = '2021-12-03';
//        Artisan::call('shares:calcProfit', [
//            '--code' => $code,
//            '--start' => $start,
//            '--end' => $end,
//            '--maSmall' => 3,
//            '--maBig' => 15,
//            '--addLine' => 15,
//        ]);
//        Artisan::call('shares:calcProfit', [
//            '--code' => $code,
//            '--start' => $start,
//            '--end' => $end,
//            '--maSmall' => 5,
//            '--maBig' => 15,
//            '--addLine' => 15,
//        ]);
//        Artisan::call('shares:calcProfit', [
//            '--code' => $code,
//            '--start' => $start,
//            '--end' => $end,
//            '--maSmall' => 5,
//            '--maBig' => 20,
//            '--addLine' => 15,
//        ]);
//        Artisan::call('shares:calcProfit', [
//            '--code' => $code,
//            '--start' => $start,
//            '--end' => $end,
//            '--maSmall' => 5,
//            '--maBig' => 22,
//            '--addLine' => 15,
//        ]);
        Artisan::call('shares:calcProfit', [
            '--code' => $code,
            '--start' => $start,
            '--end' => $end,
            '--maSmall' => 5,
            '--maBig' => 30,
            '--addLine' => 15,
        ]);
//        Artisan::call('shares:calcProfit', [
//            '--code' => $code,
//            '--start' => $start,
//            '--end' => $end,
//            '--maSmall' => 5,
//            '--maBig' => 55,
//            '--addLine' => 15,
//        ]);
//        Artisan::call('shares:calcProfit', [
//            '--code' => $code,
//            '--start' => $start,
//            '--end' => $end,
//            '--maSmall' => 5,
//            '--maBig' => 60,
//            '--addLine' => 15,
//        ]);

        return 0;
    }
}
