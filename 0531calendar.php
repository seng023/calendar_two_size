
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>簡易萬年曆</title>
    <style>
        body { font-family: Arial, sans-serif; display: flex;  justify-content: center;align-items: center;
  min-height: 100vh; background-size: cover ;  min-height: 100vh;
    margin: 0;                       }

  div.a{ position: relative;  width: 100%;  height: 300px;  }
  /* div.b{ display: flex;  flex-direction: column;  min-height: 100vh; width: 500px;  height: 300px;  }   */
        table.box { border-collapse: collapse; text-align: center ; width: 100%; max-width: 600px; margin: 20px auto;  }
       
        tr, td { border: 1px solid #ccc; text-align: center; padding: 8px; }
        tr { background-color:rgba(121, 241, 235, 0.74); }
        .holiday { background-color:rgba(13, 225, 232, 0.73); color: #d00; font-weight: bold;  }
        .today { background-color:rgba(94, 231, 238, 0.87); box-shadow:5px; }
        .nav { text-align: center; margin-bottom: 10px; }
        .nav a { margin: 0 10px; text-decoration: none; font-weight: bold; color: #333; }

.outer {
    display: flex;justify-content: center;align-items: center;
    width: 90%; max-width: 860px;
    margin: 0 auto;
    background-color:#c7dd00;
    border:dashed #FFF 1px;
    padding-bottom:40px;
    padding-top:108px;
     border-radius: 20px;
    }
.inner {
    width: 100%;
    max-width: 500px;
    
    height:315px;
    background-color:#f7f00f;
     border-radius: 20px;
    }

p:hover, h1:hover, a:hover {
  background-color: yellow;
}

@media (max-width: 600px) {
    .outer {
        width: 95%;
        padding: 10px;
    }
    .inner {
        max-width: 100%;
        height: auto;
    }
    table.box {
        font-size: 14px;
    }
}

div.a, .outer, .inner {
  overflow: visible;
}









    </style>





</head>

<body background="./pp0531.jpeg"; >
<div class="a">
    <h2  font-size: 2rem; line-height: 1.2;
  word-break: break-word; /* 允許換行 */
  white-space: normal;    /* 預設換行 */
  margin: 0;
  padding: 10px; style="background-color:rgba(255, 99, 71, 0.5);"      ><font color="#AC19C9">簡易萬年曆</font></h2>
</div>

    <?php
// 取得當前年月，若有傳入 GET 參數則使用該年月
//判断一个變數變數量是否已設設置, 即變量已被聲明，且其值不為 null
//變量的整數值
$year = isset($_GET['year']) ? intval($_GET['year']) : date('Y');
$month = isset($_GET['month']) ? intval($_GET['month']) : date('m');

// 節日設定（格式：'月-日' => '節日名稱'）
$holidays = [
    '1-1' => '元旦',
    '2-28' => 'oo生日',
    '4-10' => 'ooo生日',
    '5-1' => '勞動節',
     '6-10' => 'oooo購物網周年中慶',
      '7-7' => '世界巧克力日',
      '9-28' => '教師節',
    '10-10' => '中華民國國慶日',
     '10-25' => '台灣光復節',
    '12-25' => '不一定放假的放假日',
 
];

// 計算該月第一天是星期幾 (0=星期日, 1=星期一, ... 6=星期六)
$firstDayWeek = date('w', strtotime("$year-$month-01"));

// 計算該月天數
$daysInMonth = date('t', strtotime("$year-$month-01"));

// 取得上個月和下個月的年月，用於切換月份
$prevMonth = $month - 1;
$prevYear = $year;
if ($prevMonth < 1) {
    $prevMonth = 12;
    $prevYear--;
}

$nextMonth = $month + 1;
$nextYear = $year;
if ($nextMonth > 12) {
    $nextMonth = 1;
    $nextYear++;
}

// 月份名稱
$monthName = date('F', strtotime("$year-$month-01"));
?>

<!-- <div class="wrap"> -->
<div class="outer">
 




<div class="nav" ; style="background-color:#FFD382;padding:10px;5" ; border-radius: 20px;>
    <a href="?year=<?= $prevYear ?>&month=<?= $prevMonth ?>">&laquo; <font color="#AC19C9">上個月</font>&raquo;</a>
    <span><?= $year ?> 年 <?= $monthName ?></span>
    <a href="?year=<?= $nextYear ?>&month=<?= $nextMonth ?>">&laquo;<font color="#AC19C9">下個月</font> &raquo;</a>

    <div style="background:grgb(11, 239, 22); padding:10px; border-radius: 20px;">
  <strong><font color="#AC19C9">present by</font></strong>
  <address><font color="#AC19C9">isovi studio</font></address>
</div>



</div>



<div class="inner">
<table class="box">
    <tr>
        <td>日</td><td>一</td><td>二</td><td>三</td><td>四</td><td>五</td><td>六</td>
    </tr>
    <tr>
    <?php
    // 輸出空白格直到該月第一天的星期位置
    for ($i = 0; $i < $firstDayWeek; $i++) {
        echo "<td></td>";
    }

    // 今天日期，用來標示當天
    $today = date('Y-n-j');

    // 輸出該月日期
    for ($day = 1; $day <= $daysInMonth; $day++) {
        // 取得完整日期字串
        $dateStr = "$year-$month-$day";

        // 判斷是否為今天
        $isToday = ($dateStr == $today);

        // 判斷是否為節日
        $holidayKey = "$month-$day";
        $isHoliday = isset($holidays[$holidayKey]);

        // 設定 class
        $class = '';
        if ($isHoliday) {
            $class = 'holiday';
        } elseif ($isToday) {
            $class = 'today';
        }

        echo "<td class='$class'>";
        echo $day;
        if ($isHoliday) {
            echo "<br><small>" . $holidays[$holidayKey] . "</small>";
        }
        echo "</td>";

        // 每週六換行
        if (($firstDayWeek + $day) % 7 == 0) {
            echo "</tr><tr>";
        }
    }

    // 月份最後一天後補空白格
    $lastDayWeek = ($firstDayWeek + $daysInMonth) % 7;
    if ($lastDayWeek != 0) {
        for ($i = $lastDayWeek; $i < 7; $i++) {
            echo "<td></td>";
        }
    }
    ?>



    </tr>



</table>

</div> 

</div>




<br>


</body>


</html>



