<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use App\Models\Novel as N;
use App\Models\NovelClick;
use App\Http\Controllers\Home\Cms\Novel;

class DailyCrawlClicks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl_clicks:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每天17点抓取所有小说的点击量';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $novel = new N;
        $novel_click = new NovelClick;

        $novel_list = $novel->get();
        foreach ($novel_list as $n) {
            //抓取
            $click_time = Novel::crawlNovelClick($n);

            $record = array(
                'nc_n_id'=>$n->n_id,
                'nc_date'=>date('Y-m-d'),
                'nc_clicks'=>$click_time,
                'nc_datetime'=>date('Y-m-d H"i:s'),
            );
            $record_exists = $novel_click   ->where('nc_n_id',$record['nc_n_id'])
                                            ->where('nc_date',$record['nc_date'])
                                            ->first();
            if (!empty($record_exists)) {
                $novel_click->where('nc_n_id',$record['nc_n_id'])
                            ->where('nc_date',$record['nc_date'])
                            ->update($record);
            } else {
                $novel_click->insertGetId($record);
            }
        }

    }
}
