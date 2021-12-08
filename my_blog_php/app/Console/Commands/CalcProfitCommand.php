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
    protected $signature = 'shares:calcProfit {--code=} {--start=} {--end=} {--maSmall} {--maBig}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '股票模拟计算量化收益';

    public function init()
    {
        // 测试区间起始价格
        $this->startPrice = 0;
        // 测试区间结束价格
        $this->endPrice = 0;
        // 操作记录
        $this->operateList = [];
        // 当前单位手数
        $this->buyHands = 0;
        // 当前持仓中的买入次数
        $this->nowTimes = 0;
        // 初始止损线列表
        $this->stopLineList = [];
        // 短期均线前高
        $this->maSmallPreHigh = 0;
        // 短期均线前低
        $this->maSmallPreLow = 0;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->init();
        $code = $this->option("code");
        $start = $this->option("start");
        $end = $this->option("end");
        $maSmall = $this->option("maSmall");
        $maBig = $this->option("maBig");
        // 葛南维八大买卖法-每次买1手
        $this->method1($code, $start, $end, $maSmall, $maBig);
    }

    /**
     * 只有买点1和卖点1的双均线交易系统
     *
     * @param $code
     * @param $start
     * @param $end
     * @param $smallSize
     * @param $bigSize
     */
    public function method1($code, $start, $end, $smallSize, $bigSize)
    {
        $preList = DayData::select('today_end')
            ->where('code', $code)
            ->where('date', '<', $start)
            ->orderBy('date', 'desc')
            ->limit(100)
            ->get()
            ->pluck('today_end')
            ->toArray();

        $list = DayData::select('date', 'today_end')
            ->where('code', $code)
            ->whereBetween('date', [$start, $end])
            ->orderBy('date', 'asc')
            ->get();
        // 测试区间起始价格
        $this->startPrice = $list[0]['today_end'];
        // 测试区间结束价格
        $this->endPrice = $list[count($list)-1]['today_end'];

        $preMaBig = round(array_sum(array_slice($preList, 0, $bigSize))/$bigSize, 5);// 前一天长期均线
        $preMaSmall = round(array_sum(array_slice($preList, 0, $smallSize))/$smallSize, 5);// 前一天短期均线
        $hasBreak = $preMaSmall > $preMaBig ? 1 : 0;// 短期均线是否突破长期均线
        foreach ($list as $index => $dayData) {
            array_unshift($preList, $dayData['today_end']);
            $maBig = round(array_sum(array_slice($preList, 0, $bigSize))/$bigSize, 5);
            $maSmall = round(array_sum(array_slice($preList, 0, $smallSize))/$smallSize, 5);

            if ($maSmall > $maBig) {
                // 短期均线前低置空
                $this->maSmallPreLow = 0;
                // 短期均线首次下跌则刷新前高值，上涨突破前高则将前高置空
                if ($maSmall < $preMaSmall) {
                    if (empty($this->maSmallPreHigh)) {
                        $this->maSmallPreHigh = $preMaSmall;

                    }
                } else {
                    if (!empty($this->maSmallPreHigh) && $maSmall > $this->maSmallPreHigh) {
                        $this->maSmallPreHigh = 0;

                    }
                }

                // 是否突破首日
                if (empty($hasBreak)) {
                    $hasBreak = 1;
                    // 长期均线斜率不下降则买入
//                    if (($maBig - $preMaBig)/$preMaBig > -0.001) {
                        if (empty($this->buyHands)) {
                            // 入场买入时，根据资金管理计算买入手数
                            $this->buyHands = $this->getBuyHands($dayData['today_end']);
                        }
                        // 买入
                        $this->buy($dayData['date'], $dayData['today_end'], $this->buyHands);
//                    }
                } else {

                }
            } else {
                // 短期均线前高置空
                $this->maSmallPreHigh = 0;
                // 短期均线首次上涨则刷新前低值，下跌突破前低则将前低置空
                if ($maSmall > $preMaSmall) {
                    if (empty($this->maSmallPreLow)) {
                        $this->maSmallPreLow = $preMaSmall;

                    }
                } else {
                    if (!empty($this->maSmallPreLow) && $maSmall < $this->maSmallPreLow) {
                        $this->maSmallPreLow = 0;

                    }
                }

                $hasBreak = 0;
                $this->sell($dayData['date'], $dayData['today_end'], 0);
            }

            // 今日均线赋值给前一日均线
            $preMaBig = $maBig;
            $preMaSmall = $maSmall;
        }

        // 全部卖出
        $this->sell($end, $list[count($list)-1]['today_end'], 0);
        // 分析一下
        $this->parse();
    }

    /**
     * 买入操作
     *
     * @param $date
     * @param $price
     * @param int $hands 一个单位多少手
     */
    public function buy($date, $price, $hands=1)
    {
//        echo "{$date}买入{$hands}手，价格：{$price}，金额" . ($price * $hands * 100) . "\n";
        array_unshift($this->operateList, [
            'buy_date' => $date,
            'buy_price' => $price,
            'hands' => $hands,
            'sell_price' => 0,
            'sell_date' => '',
        ]);
        $this->nowTimes ++;// 当前持仓中的买入次数+1
    }

    /**
     * 卖出操作
     *
     * @param $date
     * @param $price
     * @param int $num 卖出单位数，0表示清仓
     */
    public function sell($date, $price, $num = 0)
    {
        $times = 0;
        foreach ($this->operateList as &$item) {
            if ($item['sell_price'] == 0) {
                $item['sell_price'] = $price;
                $item['sell_date'] = $date;
                $times++;
                $item['profit'] = ($item['sell_price'] - $item['buy_price'])  * $item['hands'] * 100;// 盈利金额
                $item['profit_ratio'] = round($item['profit']/($item['buy_price'] * $item['hands']), 2);// 盈利百分比
//                echo "{$date}卖出{$item['hands']}手，价格：{$price} 盈利：{$item['profit']}({$item['profit_ratio']}%)\n";

                $this->nowTimes --;// 当前持仓中的买入次数-1
                // 如果清仓了，则当前单位手数重置
                if (empty($this->nowTimes)) {
                    $this->buyHands = 0;
                }

                // 满足卖出手数后退出
                if (!empty($num)) {
                    if ($times == $num) {
                        break;
                    }
                }
            }
        }
    }

    /**
     * 分析结果
     *
     */
    public function parse()
    {
        $info = [
            'buy_times' =>0,
            'buy_money' => 0,// 总买入金额
            'sell_times' => 0,
            'sell_money' => 0,// 总卖出金额
            'profit_money' => 0,// 盈利金额
            'win_rate' => 0,// 胜率
            'profit_ratio' => 0,// 盈亏比
            'max_profit_rate' => 0,// 最大盈利百分比
            'max_loss_rate' => 0,// 最大亏损百分比
            'avage_profit_rate' => 0,// 平均盈利百分比
        ];

        $winTimes = 0;// 盈利次数
        $allProfitMoney = 0;// 累计盈利金额
        $allLossMoney = 0;// 累计亏损金额

        foreach ($this->operateList as $item) {
            $info['buy_times'] += 1;
            $info['buy_money'] += $item['buy_price'] * $item['hands'] * 100;
            $info['sell_times'] += 1;
            $info['sell_money'] += $item['sell_price'] * $item['hands'] * 100;
            if ($item['profit'] > 0) {
                $winTimes++;
                $allProfitMoney += $item['profit'];
            } else {
                $allLossMoney -= $item['profit'];
            }
        }

        $info['profit_money'] = $info['sell_money'] - $info['buy_money'];
        $info['win_rate'] = round($winTimes/$info['buy_times'], 4) * 100;
        $info['profit_ratio'] = round(($allProfitMoney/$winTimes)/($allLossMoney/(count($this->operateList) - $winTimes)), 2);
        $profitRatioList  = array_column($this->operateList, 'profit_ratio');
        $profitList = array_column($this->operateList, 'profit');
        $info['avage_profit_rate'] = round(array_sum($profitRatioList)/ count($profitRatioList), 2);

        echo '股价区间涨幅：' . round(($this->endPrice - $this->startPrice)/$this->startPrice, 2) * 100  . "%\n";
        echo '胜率：' . $info['win_rate'] . "%\n";
        echo '盈亏比：' . $info['profit_ratio'] . "\n";
        echo '盈利金额：' . $info['profit_money'] . "\n";
        echo '买入次数：' . $info['buy_times'] . "\n";
        echo '平均盈利百分比：' . $info['avage_profit_rate'] . "%\n";
        echo '盈利百分比列表：' . join('%, ', $profitRatioList) . "%\n";
        rsort($profitRatioList);
        echo '盈利百分比排序：' . join('%, ', $profitRatioList) . "%\n";
    }

    /**
     * 根据资金管理计算买入手数
     *
     * @param $price
     * @return int
     */
    public function getBuyHands($price)
    {
        $unitMoney = 100000;// 单位头寸金额
        $hands = 1;
        $money = $price * 100;
        while ($money < $unitMoney) {
            $hands++;
            $money += $price * 100;
        }
        return $hands-1;
    }
}
