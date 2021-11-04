<?php

namespace App\Util;

use App\Models\Holiday;

class WorkDayUtil
{
    /**
     * 查询一个日期是否是工作日，若是工作日，返回True，若不是工作日，返回False
     *
     * @param $dateTime e.g. '2020-07-28' or '2020-07-28 10:00:00'
     * @return bool
     */
    public static function isWorkDay($dateTime)
    {
        $date = date('Y-m-d',strtotime($dateTime));
        if (strpos($dateTime,$date) === false)
            return false;

        //先查询是否是库里的特殊日期
        $record = Holiday::where('date',$date)->first();
        if (!empty($record)) {
            return $record->type == 1 ? false : true ;
        }

        //再判断是否周六周日
        $weekDay = date("w", strtotime($date));
        if($weekDay == 0 || $weekDay == 6){
            return false;
        }

        return true;
    }

    /**
     * 获取一个时间段中每个日期的详情map
     *
     * @param $start e.g. '2020-07-28' or '2020-07-28 10:00:00'
     * @param $end e.g. '2020-07-28' or '2020-07-28 10:00:00'
     * @return array
     */
    public static function dateDetailMap($start,$end)
    {
        $map = [];
        $startTimestamp = strtotime($start);
        $endTimestamp = strtotime($end);
        $startDate = date('Y-m-d',$startTimestamp);
        $endDate = date('Y-m-d',$endTimestamp);
        if (strpos($start,$startDate) !== false && strpos($end,$endDate) !== false && $start <= $end) {
            $endDate = strpos($end,'00:00:00') === false ? $endDate : date('Y-m-d',$endTimestamp-86400) ;//00:00:00结束日期视作前一天
            //先查询是否是库里的特殊日期
            $records = Holiday::whereBetween('date',[$startDate,$endDate])->get();
            foreach ($records as $record) {
                $dateStartTimestamp = strtotime($record->date);
                $dateEndTimestamp = $dateStartTimestamp + 86400;
                $tmp = [];
                $tmp['startTimestamp'] = max($startTimestamp,$dateStartTimestamp);//开始时间戳
                $tmp['endTimestamp'] = min($endTimestamp,$dateEndTimestamp);//结束时间戳
                $tmp['is_holiday'] = $record->type == 1;//是否假期
                $map[$record->date] = $tmp;
            }
            //再判断是否周六周日
            for ($i = $startDate; $i <= $endDate; $i = date('Y-m-d',strtotime($i)+86400)) {
                if (!array_key_exists($i,$map)) {
                    $dateStartTimestamp = strtotime($i);
                    $dateEndTimestamp = $dateStartTimestamp + 86400;
                    $weekDay = date("w", $dateStartTimestamp);
                    $tmp = [];
                    $tmp['startTimestamp'] = max($startTimestamp,$dateStartTimestamp);//开始时间戳
                    $tmp['endTimestamp'] = min($endTimestamp,$dateEndTimestamp);//结束时间戳
                    $tmp['is_holiday'] = $weekDay == 0 || $weekDay == 6;//是否假期
                    $map[$i] = $tmp;
                }
            }
        }
        return $map;
    }

    /**
     * 获取一个时间段中的所有工作日
     *
     * @param $start e.g. '2020-07-28' or '2020-07-28 10:00:00'
     * @param $end e.g. '2020-07-28' or '2020-07-28 10:00:00'
     * @return array
     */
    public static function workDayList($start,$end)
    {
        $map = array_filter(
            self::dateDetailMap($start,$end),
            function ($v) {return !$v['is_holiday'];}
        );
        return array_keys($map);
    }

    /**
     * 获取一个时间段中的所有节假日
     *
     * @param $start e.g. '2020-07-28' or '2020-07-28 10:00:00'
     * @param $end e.g. '2020-07-28' or '2020-07-28 10:00:00'
     * @return array
     */
    public static function holidayList($start,$end)
    {
        $map = array_filter(
            self::dateDetailMap($start,$end),
            function ($v) {return $v['is_holiday'];}
        );
        return array_keys($map);
    }
}
