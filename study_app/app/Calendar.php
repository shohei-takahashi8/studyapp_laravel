<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Calendar extends Model
{
    private $html;
    private $today;

    public function __construct($today) {
        $this->today = $today;
    }

    public function showCalendarTag($m, $y) {
        $year = $y;
        $month = $m;
        if(!($month > 0 && $month <= 12)) {
            $year = $this->today->year;
            $month = $this->today->month;
        }
        if($year == null || $month == null) {
            $year = $this->today->year;
            $month = $this->today->month;
        }


        //prev month
        $prev = strtotime('-1 month', mktime(0, 0, 0, $month, 1, $year));
        $prevYear = date("Y", $prev);
        $prevMonth = date("m", $prev);

        //next month
        $next = strtotime('+1 month', mktime(0, 0, 0, $month, 1, $year));
        $nextYear = date("Y", $next);
        $nextMonth = date("m", $next);

        $firstWeekDay = date("w", mktime(0, 0, 0, $month, 1, $year));
        $lastDay = date("t", mktime(0, 0, 0, $month, 1, $year));

        $day = 1 - $firstWeekDay;
        $this->html = <<< EOS
        <h3 class="text-center">
            <a class="btn btn-primary" href="/calendar?year={$prevYear}&month={$prevMonth}" role="button">&lt;前月</a>
            {$year}年{$month}月
            <a class="btn btn-primary" href="/calendar?year={$nextYear}&month={$nextMonth}" role="button">翌月&gt;</a>
        </h3>
        <table class="table table-bordered" style="table-layout: fixed;">
            <tr>
            <th scope="col" class="text-center">日</th>
            <th scope="col" class="text-center">月</th>
            <th scope="col" class="text-center">火</th>
            <th scope="col" class="text-center">水</th>
            <th scope="col" class="text-center">木</th>
            <th scope="col" class="text-center">金</th>
            <th scope="col" class="text-center">土</th>
            </tr>
EOS;

        while($day <= $lastDay) {
            $this->html .= "<tr>";

            for($i = 0; $i < 7; $i++) {
                if($day <= 0 || $day > $lastDay) {
                    $this->html .= "<td>&nbsp;</td>";
                }else {
                    $target = date("Y-m-d", mktime(0, 0, 0, $month, $day, $year));
                    if($target === $this->today->format('Y-m-d')) {
                        $this->html .= "<td class='today text-center'><a href='/study?year={$year}&month={$month}&day={$day}'>" . $day . "&nbsp";
                    }else {
                        $this->html .= "<td class='text-center'><a href='/study?year={$year}&month={$month}&day={$day}'>" . $day . "&nbsp";
                    }
                    $this->html .= "</a></td>";
                }
                $day++;
            }
            $this->html .= "</tr>";
        }

        return $this->html .= "</table>";
    }

}