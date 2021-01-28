<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PhpCSController extends Controller {
    public function ceshi() {
        $a = 'https://note.youdao.com/web/#/file/recent/note/WEBfe2900dd09246321d9b6af3a8b31f58c/a.php';
        $b = '../../api.php';
        var_dump(basename($a),basename($b));
        var_dump(dirname($a),dirname($b));
        var_dump(pathinfo($a),pathinfo($b));
        var_dump(filetype($a),filetype($b));
    }


    /**
     */
    public function zongjie() {
        //php数组和字符串函数,类,面试题,laravel定时任务,git,堆和栈,雪崩,设计模式,数据结构,负载均衡,异常,闭包,递归

        //配置https + 申请免费ssl证书 : https://jingyan.baidu.com/article/19192ad8d81ec3e53f57077d.html  步骤:阿里云申请ssl免费证书->提交申请->申请通过后签发证书->下载证书(包括两个文件密钥key和证书pem)->宝塔面板就设置到网站中,不是宝塔面板就保存证书到服务器,然后在nginx配置文件中设置一下就可以
        //如果是宝塔面板搭建的站点,从阿里云或者其他渠道下载证书,证书包括两个文件 .key文件和.pem文件,然后进入到宝塔面板的站点设置,找ssl,将两个证书的内容复制到相应位置,保存,重启则http和https都可以使用,默认走http,如果你想走https,则点击强制https



        /*
         总结 : array_search(value,array,strict)  在数组中找到该value对应的key,没找到返回false,找到多次返回第一次找到的key
         * */

        /*总结
        reset() 函数将内部指针指向数组中的第一个元素，并输出。
        current() - 返回数组中的当前元素的值
        end() - 将内部指针指向数组中的最后一个元素，并输出
        next() - 将内部指针指向数组中的下一个元素，并输出
        prev() - 将内部指针指向数组中的上一个元素，并输出
        each() - 返回当前元素的键名和键值，并将内部指针向前移动
        */

        /*
         总结 :
         strcasecmp();比较两个字符串(不区分大小写),返回0则两个字符串相等<0 - 如果 string1 小于 string2>0 - 如果 string1 大于 string2
         strcmp();比较两个字符串(区分大小写),返回0则两个字符串相等<0 - 如果 string1 小于 string2>0 - 如果 string1 大于 string2
         substr_count($a,$b);查看$b字符串在$a中出现多少次
         * */

        /*总结:
         一、ceil — 进一法取整  二、floor — 舍去法取整
        array_count_values() 函数用于统计数组中所有值出现的次数。会返回一个数组,key是各个值,value是每个值出现的次数
        array_filter(),过滤函数
        总结 : array_keys获取数组所有的key,如果array($arr,$value),那么就是获取所有value的键,返回的是个带有键的一维数组
        总结str_split($a,2);将$a这个字符串分成数组,每两个成为一个数组元素    array_chunk(array,size,preserve_keys);分割数组,参数:array数组,size规定每个新数组块包含多少个元素,preserve_keys true保留原始数组中的键名。false默认。每个新数组块使用从零开始的索引。
         * */
    }

    public function PhpTest() {
        //1.错误报告
        //$a = error_reporting();
        //var_dump($a);

        //2.跳转
        //header("Location:http://www.baidu.com");//直接跳转
        //header("refresh:3;url=http://www.baidu.com");//三秒后跳转
        $nums = [-1, 4, 2, 3];
        sort($nums);
        var_dump(1000000008 % 1000000007);
    }

    public function suanfaCeshi(Request $request) {
        $a = false;
        if(isset($a)){
            echo '成功1';
        }else{
            echo '失败1';
        }

        if(empty($a)){
            echo '成功2';
        }else{
            echo '失败2';
        }
    }

    //算法题1.早餐问题
    public function suanfa1(Request $request) {
        $staple = $request->input('staple');
        $drinks = $request->input('drinks');
        $x      = $request->input('x');

        //题目 : 小扣在秋日市集选择了一家早餐摊位，一维整型数组 staple 中记录了每种主食的价格，一维整型数组 drinks 中记录了每种饮料的价格。小扣的计划选择一份主食和一款饮料，且花费不超过 x 元。请返回小扣共有多少种购买方案。注意：答案需要以 1e9 + 7 (1000000007) 为底取模，如：计算初始结果为：1000000008，请返回 1
        //解题 : 数据量特别大的时候,不能用两个嵌套的foreach或者for去计算,先将两个数据从小到大排序,然后while循环,staple的最小的和drinks中的最大的相加如果小于x,如果符合条件,那么在staple中的$i++进行下一个元素的计算,不符合条件的则$j--,用drinks中的上一个元素计算,这么做也相当与对两个数组进行循环计算
        sort($staple);
        sort($drinks);
        $num = 0;
        $s   = count($staple);
        $d   = count($drinks);

        $i = 0;
        $j = $d - 1;
        while ($i < $s && $j >= 0) {//总结:while循环是条件成立则运行,重点是条件,for循环重点是次数
            if ($staple[$i] + $drinks[$j] <= $x) {
                $num = ($num + $j + 1) % 1000000007;
                $i++;
            } else {
                $j--;
            }
        }
        var_dump($num % 1000000007);
    }

    //算法题2.亲密字符串
    public function suanfa2(Request $request) {
        //题目 : 给定两个由小写字母构成的字符串 A 和 B ，只要我们可以通过交换 A 中的两个字母得到与 B 相等的结果，就返回 true ；否则返回 false 。交换字母的定义是取两个下标 i 和 j （下标从 0 开始），只要 i!=j 就交换 A[i] 和 A[j] 处的字符。例如，在 "abcd" 中交换下标 0 和下标 2 的元素可以生成 "cbad" 。


        //strcasecmp();比较两个字符串(不区分大小写),返回0则两个字符串相等<0 - 如果 string1 小于 string2>0 - 如果 string1 大于 string2
        //strcmp();比较两个字符串(区分大小写),返回0则两个字符串相等<0 - 如果 string1 小于 string2>0 - 如果 string1 大于 string2
        //substr_count($a,$b);查看$b字符串在$a中出现多少次
        $A = $request->input('A');
        $B = $request->input('B');

        //优质答案
        if (strlen($A) != strlen($B)) {
            return false;
        }

        $map = [];
        if ($A == $B) {
            for ($i = 0; $i < strlen($A); $i++) {
                if (in_array($A[$i], $map)) {
                    return true;
                } else {
                    $map[] = $A[$i];
                }
            }

            return false;
        } else {
            $first = $second = -1;
            for ($i = 0; $i < strlen($A); $i++) {
                if ($A[$i] != $B[$i]) {
                    if ($first == -1) {
                        $first = $i;
                    } elseif ($second == -1) {
                        $second = $i;
                    } else {
                        return false;
                    }
                }
            }

            return ($second != -1) && $A[$first] == $B[$second] && $A[$second] == $B[$first];
        }
    }

    //算法题3.种花问题
    public function suanfa3(Request $request) {
        //一、ceil — 进一法取整  二、floor — 舍去法取整
        //array_count_values() 函数用于统计数组中所有值出现的次数。会返回一个数组,key是各个值,value是每个值出现的次数
        //假设你有一个很长的花坛，一部分地块种植了花，另一部分却没有。可是，花卉不能种植在相邻的地块上，它们会争夺水源，两者都会死去。给定一个花坛（表示为一个数组包含0和1，其中0表示没种植花，1表示种植了花），和一个数 n 。能否在不打破种植规则的情况下种入 n 朵花？能则返回True，不能则返回False。
        //我的答案还不错
        $flowerbed = [1, 0, 0, 0, 1];
        $n         = 2;
        $num       = 0;
        if ($flowerbed[0] == 0 && $flowerbed[1] == 0) {
            $num++;
            $a = 2;
        } else {
            $a = 1;
        }

        for ($i = $a; $i < count($flowerbed);) {
            if ($flowerbed[$i - 1] == 0 && $flowerbed[$i] == 0 && $flowerbed[$i + 1] == 0) {
                $num++;
                $i = $i + 2;
            } else {
                $i = $i + 1;
            }
        }
        if ($num >= $n) return true;
        else return false;
    }

    //算法题4.
    public function suanfa4(Request $request) {
        //题目 : 给定一个仅包含大小写字母和空格 ' ' 的字符串 s，返回其最后一个单词的长度。如果字符串从左向右滚动显示，那么最后一个单词就是最后出现的单词。如果不存在最后一个单词，请返回 0 。说明：一个单词是指仅由字母组成、不包含任何空格字符的 最大子字符串。

        $s   = "Hello World";
        $arr = explode(' ', $s);
        $num = count($arr);
        if ($num < 1) return 0;
        for ($i = $num - 1; $i >= 0; $i--) {
            if (strlen($arr[$i]) != 0) {
                return strlen($arr[$i]);
            }
        }
        return 0;
    }


    //算法题5.
    public function suanfa5(Request $request) {
        $s = '';
        //统计字符串中的单词个数，这里的单词指的是连续的不是空格的字符。/请注意，你可以假定字符串里不包括任何不可打印的字符。
        //array_filter(),过滤函数
        $arr = explode(' ', $s);
        return count(array_filter($arr));
    }

    public function suanfa6(Request $request) {
        $strs = ["ab", "a"];
        if (count($strs) == 1) return $strs[0];
        $arr = [];
        foreach ($strs as $k => $v) {
            $arr[] = strlen($v);
        }
        $num = min($arr);
        $x   = '';
        //for($i=0;$i<=$num-1;$i++){
        //    $new = [];
        //    foreach($strs as $k=>$v){
        //        $new[] = $v[$i];
        //    }
        //    $count = array_count_values($new);
        //    if(count($count)==1) $x .= $strs[0][$i];
        //    else return $x;
        //}

        for ($i = 0; $i <= $num - 1; $i++) {
            $jizhun  = $strs[0][$i];
            $kaiguan = true;
            foreach ($strs as $k => $v) {
                if ($v[$i] != $jizhun) $kaiguan = false;
            }
            if ($kaiguan) $x .= $jizhun;
            else return $x;
        }
        return $x;
    }

    public function suanfa7(Request $request) {
        //题目 : 给定一个整数数组 A，如果它是有效的山脉数组就返回 true，否则返回 false。
        //让我们回顾一下，如果 A 满足下述条件，那么它是一个山脉数组：
        //A.length >= 3
        //在 0 < i < A.length - 1 条件下，存在 i 使得：
        //A[0] < A[1] < ... A[i-1] < A[i]
        //A[i] > A[i+1] > ... > A[A.length - 1]

        //总结 : array_keys获取数组所有的key,如果array($arr,$value),那么就是获取所有value的键,返回的是个带有键的一维数组

        $arr   = [0, 3, 2, 1];
        $count = count($arr);
        if ($count < 3) return '失败1';
        $max = max($arr);
        $key = array_keys($arr, $max);
        if (count($key) >= 2) return '失败2';
        if ($key[0] == 0 || $key[0] == $count - 1) return '失败3';

        for ($i = 0; $i < $count; $i++) {
            if ($i < $key[0]) {
                if ($arr[$i] >= $arr[$i + 1]) return '失败4';
            }
            if ($i > $key[0]) {
                if ($arr[$i] >= $arr[$i - 1]) return '失败5';
            }
        }
        return true;
    }


    public function suanfa8(Request $request) {
        //总结str_split($a,2);将$a这个字符串分成数组,每两个成为一个数组元素
        $name  = "leelee";
        $typed = "lleeelee";
        //$count_name = strlen($name);
        //$count_typed = strlen($typed);
        //$i=0;
        //$j=0;
        //while($i<$count_name && $j<$count_typed){
        //    if($i+1==$count_name){
        //        if($name[$i]==$typed[$j]){
        //            $j++;
        //        }
        //    }else{
        //        if($name[$i]==$name[$i+1]){
        //            if($name[$i]==$typed[$j]){
        //                $j++;
        //                $i++;
        //            }else{
        //                return false;
        //
        //            }
        //        }else{
        //            if($name[$i]==$typed[$j]){
        //                $j++;
        //            }else{
        //                if($name[$i+1]!=$typed[$j]){
        //                    return false;
        //                }else{
        //                    $i++;
        //                }
        //
        //            }
        //        }
        //    }
        //
        //}
        //return tue;

        $name_arr  = str_split($name);
        $typed_arr = str_split($typed);
        $n_len     = count($name_arr);
        $t_len     = count($typed_arr);

        $i = 0;
        $j = 0;
        while ($i < $n_len && $j < $t_len) {
            if ($name_arr[$i] == $typed_arr[$j]) { // 相等同时右移一位
                $i++;
                $j++;
            } elseif ($j > 0 && $typed_arr[$j] == $typed_arr[$j - 1]) { // 重复按的情况，type右移一位
                $j++;
            } else {
                return false;
            }
        }

        // type 还没走完，剩下的都和前面一样
        while ($j < $t_len && $typed_arr[$j] == $typed_arr[$j - 1]) {
            $j++;
        }

        // 两者都走到最后一位，才算匹配
        return $i == $n_len && $j == $t_len;
    }


    public function suanfa9(Request $request) {
        var_dump($request->all());
        die;
        //1.每个月最少20个工作日,最多23个工作日  2.北京地铁3元起步价，单程最高票价目前是9元   3.100元以上80%,150元以上50%
        //求出,到100元的时间,到150元的时间,总价
        //$ticket = $request->input('ticket');
        //$workday = $request->input('workday');

        $all     = [];
        $ticket  = [3, 4, 5, 6, 7, 8, 9];
        $workday = [20, 21, 22, 23];

        foreach ($ticket as $v1) {
            foreach ($workday as $v2) {
                $total   = 0;
                $enjoy80 = '无';
                $enjoy50 = '无';
                for ($i = 1; $i <= $v2 * 2; $i++) {
                    if ($total >= 150) {
                        if ($total < $v1 + 150) $enjoy50 = $i / 2;
                        $total = bcadd($total, bcmul($v1, 0.5, 5), 5);
                    } elseif ($total >= 100) {
                        if ($total < $v1 + 100) $enjoy80 = $i / 2;
                        $total = bcadd($total, bcmul($v1, 0.8, 5), 5);
                    } else {
                        $total += $v1;
                    }
                }

                $all[] = ['票价' => $v1, '工作日' => $v2, '80%' => $enjoy80, '50%' => $enjoy50, '总价' => $total];
            }
        }
        return $all;

        //$enjoy50 = 0;
        //$enjoy80 = 0;
        //$total = 0;
        //$ticket = 9;
        //for($i=1;$i<=23;$i++){
        //    if($total>=150){
        //        if($total<$ticket+150) $enjoy50 = $i;
        //        $total += $ticket*0.5;
        //    }elseif($total>=100){
        //        if($total<$ticket+100) $enjoy80 = $i;
        //        //$total += strval($ticket*0.8);
        //        //var_dump($ticket*0.8,$total);
        //        //var_dump($total);
        //        $total = bcadd($total,bcmul($ticket,0.8,5),5);
        //        var_dump(bcmul($ticket,0.8,5),$total);
        //    }else{
        //        $total += $ticket;
        //    }
        //}
        //return ['票价'=>$ticket,'工作日'=>20,'80%'=>$enjoy80,'50%'=>$enjoy50,'总价'=>$total];

    }

    public function subwayPay(Request $request) {
        date_default_timezone_set('Asia/Shanghai');
        $name    = strval($request->input('name'));
        $ticket  = intval($request->input('ticket'));
        $date   = strval($request->input('date'));
        $days    = intval($request->input('days'));
        $message = strval($request->input('message'));
        if(!isset($name) || mb_strlen($name)>20) return '姓名有误';
        if(!isset($ticket) || $ticket<3 || $ticket>9) return 'ticket有误';
        if($days){
            if($days<1 || $days>31) return 'days有误';
        };

        //判断日期是否正确
        $riqi = explode('-',$date);
        if(!$riqi[0] || !$riqi[1]) return '日期有误';
        $year = intval($riqi[0]);
        $month = intval($riqi[1]);
        if($year<1970 || $year>9900) return '年有误';
        if($month<1 || $month>12) return '月有误';
        //end

        $now = date('Y-m-d H:i:s',time());
        $id = DB::table('subwayUse')->insertGetId(
            ['inputtime' => $now, 'name' => $name,'ticket'=>$ticket,'date'=>$date,'days'=>$days,'message'=>$message]
        );


        $worksdays = $this->workDays($year,$month);
        $enjoy50 = 0;
        $enjoy80 = 0;
        $total = 0;
        for($i=1;$i<=$worksdays*2;$i++){
            if($total>=150){
                if($total<$ticket+150) $enjoy50 = $i;
                $total = bcadd($total,bcmul($ticket,0.5,5),2);
            }elseif($total>=100){
                if($total<$ticket+100) $enjoy80 = $i;
                $total = bcadd($total,bcmul($ticket,0.8,5),2);
            }else{
                $total = bcadd($total,$ticket,2);
            }
        }
        $dateData = ['ticket'=>$ticket,'days'=>$worksdays,'enjoy80'=>$enjoy80/2,'enjoy50'=>$enjoy50/2,'total'=>$total];


        $dayData = [];
        if($days){
            $enjoy50 = 0;
            $enjoy80 = 0;
            $total = 0;
            for($i=1;$i<=$days*2;$i++){
                if($total>=150){
                    if($total<$ticket+150) $enjoy50 = $i;
                    $total = bcadd($total,bcmul($ticket,0.5,5),2);
                }elseif($total>=100){
                    if($total<$ticket+100) $enjoy80 = $i;
                    $total = bcadd($total,bcmul($ticket,0.8,5),2);
                }else{
                    $total = bcadd($total,$ticket,2);
                }
            }
            $dayData = ['ticket'=>$ticket,'days'=>$days,'enjoy80'=>$enjoy80/2,'enjoy50'=>$enjoy50/2,'total'=>$total];
        }
        return view('subway.subwayShow', ['dateData'=>$dateData,'dayData'=>$dayData,'name'=>$name,'date'=>$date,'id'=>$id]);

    }

    public function workDays($year,$month){
        $day=1;
        $days=0;
        $t=mktime(0,0,0,$month,$day,$year);
        $days=date('t',$t);
        $fristDayWeek=date('w',$t);//每月一号的星期数
        $lastDayWeek=date('w',mktime(0,0,0,$month,$days,$year));//每月最后一天的星期数
        if($days>28){//非平年二月算法，平年二月无论怎么都只有20天。
            if($fristDayWeek==6)//起始日是星期六的减去2天，星期天的减去一天。
                $days-=2;
            if($fristDayWeek==0)
                $days-=1;
            if($lastDayWeek==6)//结束日是星期六的减去一天，星期天的减去2天。
                $days-=1;
            if($lastDayWeek==0)
                $days-=2;
        }

        if($days<28)//每个月最少会工作20天，此处修正开始日期是星期六，结束日期是星期天的31天的月份

            $days=28;
        return $days-8;// 减去每个月都有的4个星期天共8天
    }

    public function forKobe(Request $request) {
        date_default_timezone_set('Asia/Shanghai');
        $id = $request->input('id');
        $talk = $request->input('talk') ? $request->input('talk')  : '无';
        $data = DB::table('subwayUse')->where(['id'=>$id])->value('id');
        //var_dump($data);die;
        if($data){
            DB::table('subwayUse')
                ->where('id', $id)
                ->update(['talk' => $talk]);
        }else{
            $now = date('Y-m-d H:i:s',time());
            DB::table('subwayUse')->insertGetId(
                ['inputtime' => $now,'talk'=>$talk]
            );
        }
        return view('subway.subwayIndex');
    }

    //定时任务
    public function crontab(){
        /*
         laravel定时任务步骤
         1.在laravel根目录(就是artisan文件的目录)中执行命令  php artisan make:command Test  (laravel5.2及以前的版本使用make:console命令),创建完成后会在app/Console/Commands/目录下创建Test.php文件
         2.Test文件的handle函数是任务要写的地方
         3.在app/Console/Kernel.php中完成注册。
            protected $commands = [
                Commands\TestConsole::class
            ];
         4.在服务器上创建linux定时任务去每分钟执行laravel的定时器,这样laravel的定时任务才好用   * * * * * /usr/bin/php7.0 /var/www/html/laravel/artisan schedule:run >> /dev/null 2>&1
         * */

    }

    //缓存雪崩
    public function huancun(){
        //https://blog.csdn.net/kongtiao5/article/details/82771694
    }


}