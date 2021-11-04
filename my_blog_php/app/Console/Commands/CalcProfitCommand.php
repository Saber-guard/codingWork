<?php

namespace App\Console\Commands;

use App\Models\CompanyInfo;
use App\Models\DayData;
use Illuminate\Console\Command;

class CalcProfitCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shares:calcProfit {--code=} {--start=} {--end=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '股票模拟计算量化收益';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $code = $this->option("code");
        $start = $this->option("start");
        $end = $this->option("end");
        // 葛南维八大买卖法-每次买1手
        $this->method1($code, $start, $end);
    }

    public function method1($code, $start, $end)
    {
        $buy = $sell = 0;// 买入、卖出金额
        $num = 0;// 交易次数
        $holdHands = 0;// 当前持仓手数
        $unitHands = 2;// 每次买入卖出手数
        $maxHoldMoney = 0;// 最大占用金额
        $holdDay = 0;// 持仓日期

        $preList = DayData::select('today_end')
            ->where('code', $code)
            ->where('date', '<', $start)
            ->orderBy('date', 'desc')
            ->limit(40)
            ->get()
            ->pluck('today_end')
            ->toArray();

        $list = DayData::select('date', 'today_end')
            ->where('code', $code)
            ->whereBetween('date', [$start, $end])
            ->orderBy('date', 'asc')
            ->get();

        // 开始遍历计算
        $hasBreak = 0;
        foreach ($list as $index => $dayData) {
            array_unshift($preList, $dayData['today_end']);
            $average1 = round(array_sum(array_slice($preList, 0, 5))/5, 2);
            $average2 = round(array_sum(array_slice($preList, 0, 30))/30, 2);

            // 初始状态短期均线是否突破长期均线
            if ($index == 0) {
                $hasBreak = ($average1 >= $average2 ? 1 : 0);
                echo '初始状态' . ($hasBreak == 1 ? '突破' : '未突破') . "\n";
            }

            echo $dayData['date'] . '短期均线：' . $average1 . ',长期均线：' . $average2 . ',当日收盘价：' . $dayData['today_end'] . '    ';
            if ($average1 >= $average2) {
                if ($hasBreak == 0) {
                    $hasBreak = 1;
                    $num += 1;
                    $buy += $dayData['today_end'] * 100 * $unitHands;
                    $holdHands += $unitHands;
                    echo '已突破，' . $dayData['today_end'] . '买入    ';
                } else {
                    echo '等待破位    ';
                }
            } else {
                if ($hasBreak == 1) {
                    $hasBreak = 0;
                    if ($holdHands > 0) {
                        $num += 1;
                        $sell += $dayData['today_end'] * 100 * $unitHands;
                        $holdHands -= $unitHands;
                        echo '已破位，' . $dayData['today_end'] . '卖出    ';
                    } else {
                        echo '已破位，未持有仓位';
                    }
                } else {
                    echo '等待突破    ';
                }
            }

            // 计算最大占用金额
            $tmpHoldMoney = $holdHands * $dayData['today_end'] * 100;
            $maxHoldMoney = max($maxHoldMoney, $tmpHoldMoney);
            // 计算持仓日期
            !empty($holdHands) && $holdDay+=1;


            echo "\n";
        }
        echo "买入金额：{$buy}  卖出金额{$sell}  持仓手数{$holdHands}  交易次数{$num}  最大占用金额{$maxHoldMoney}  持仓日期占比" .
            $holdDay/count($list) . "  盈利金额" .
            ($sell + $tmpHoldMoney - $buy - 5 * $num) . "\n";
    }
}
