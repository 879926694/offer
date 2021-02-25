<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;

class PhpCSController extends Controller {
    public $num = 1;
    public function ceshi() {
        $a = $this->niu(12);
        var_dump($a);
    }

    public function niu($n){
        for ($i=1;$i<=$n;$i++)
        {
            if($i>=4 && $i<15)
            {
                $this->num++;
                $this->niu($n-$i);
            }
            elseif($i==20)
            {
                $this->num--;
            }
        }
        return  $this->num;
    }


    /**
     */
    public function zongjie() {
        //php数组和字符串函数,类,面试题,laravel定时任务,git,堆和栈,雪崩,设计模式,数据结构,负载均衡,异常,闭包,递归,php操作文件,算法,redis缺点,sql防注入,xss攻击,文件操作,socket,分区分表



        //配置https + 申请免费ssl证书 : https://jingyan.baidu.com/article/19192ad8d81ec3e53f57077d.html  步骤:阿里云申请ssl免费证书->提交申请->申请通过后签发证书->下载证书(包括两个文件密钥key和证书pem)->宝塔面板就设置到网站中,不是宝塔面板就保存证书到服务器,然后在nginx配置文件中设置一下就可以
        //如果是宝塔面板搭建的站点,从阿里云或者其他渠道下载证书,证书包括两个文件 .key文件和.pem文件,然后进入到宝塔面板的站点设置,找ssl,将两个证书的内容复制到相应位置,保存,重启则http和https都可以使用,默认走http,如果你想走https,则点击强制https


        //总结 : isset(只有null是不存在的,false,空字符串,空数组,0都是存在的,注意使用这个函数时必须使用变量,不能直接放参数)   empty(false,null,空字符串,空数组,0都算空)


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
         strcasecmp();比较两个字符串(不区分大小写),比较两个字符串(不区分大小写),相等返回0   如果 string1 小于 string2则返回小于0(如果字符串前面相等,那么谁长度长就大)
         strcmp();比较两个字符串(区分大小写),相等返回0   如果 string1 小于 string2则返回小于0(小于的含义是如果字符串前面相等,那么谁长度长就大,如果前面不一样,那么小写的比较大,不管长度多少,返回的基本是长度,而不是1或-1)
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

    public function mianshiti(){
        /*
        面试题1.
        1.清除html标签的函数
        $str = 'www<p>dreamdu</p>.com';
        echo(htmlspecialchars($str));    www&lt;p&gt;dreamdu&lt;/p&gt;.com
        echo(strip_tags($str));   wwwdreamdu.com
        2.sql防注入 : 数字条件用intval()  2.字符串变量,用addslashes()会把所有单引号,双引号,反斜线,和空字符串转为含有反斜线的溢出字符
        3.memcache
        端口11211,常用命令add,replace,set,get,delect
        redis持久化  : 内存快照 客户端用save命令告诉redis需要做一次内存快照
        ,日志追加
        4.bootstrip
        5.http  :1xx请求已接收,继续处理  2xx成功   3xx重定向   4xx客户端错误   5xx服务器端错误
        400客户端请求有错误,不能为服务器所理解
        403服务器收到请求,但是拒绝提供服务
        404找不到资源
        500服务器发生不可预期的错误
        503服务器当前不能处理客户端请求,一段时间之后可能恢复

        sql语句优化 避免在列上用函数去运算,会导致索引失效,使用like时候尽量避免用%%,不要selet *,虽然速度上不会有影响,但是节省内存,尽量使用批量插入,不要循环插入,不适用rand去获取随机记录,避免使用null,不要使用conut(id,)而是count(*),尽量在索引中完成排序
        mysql服务器优化 : 关闭不必要的二进制日志和慢查询日志,增加mysql的最大链接数,删除大量行后,可运行OPTIMIZE TABLE TableName进行碎片整理
        最重要的是增加服务器CUP数量和内存的大小
        7.web安全知识
        xss攻击 常指黑客通过“HTML注入”篡改网页，插入恶意的脚本，从而在用户浏览网页时，控制用户浏览器的一种攻击。
        将重要的cookie标记为http only,   这样的话Javascript 中的document.cookie语句就不能获取到cookie了.
        只允许用户输入我们期望的数据。 例如：　年龄的textbox中，只允许用户输入数字。 而数字之外的字符都过滤掉。
        对数据进行Html Encode 处理
        过滤或移除特殊的Html标签， 例如: <script>, <iframe> ,  &lt; for <, &gt; for >, &quot for
        过滤JavaScript 事件的标签。例如 "onclick=", "onfocus" 等等。

        CSRF攻击（跨站点请求伪造）：顾名思义，是伪造请求，冒充用户在站内的正常操作
        通过session token来实现保护。当客户端请求页面时，服务器会生成一个随机数Token，并且将Token放置到session当中，然后将Token发给客户端（一般通过构造hidden表单）。下次客户端提交请求时，Token会随着表单一起提交到服务器端。接收到请求后，服务器端会对Token值进行验证，判断是否和session中的Token值相等，若相等，则可以证明请求有效，不是伪造的。
        8.伪静态

        4.获取文件信息
        basename()-返回路径的文件名
        dirname()-返回当前脚本的文件路径！
        pathinfo();获取信息
        在PHP获取客户端IP时，常使用 $_SERVER["REMOTE_ADDR"] 


        4.有一堆数字$arr=array(12,65,110,2,3,55,79,10,45);等很多数字并且没有重复的,要求是输出第一个数是最大的,第二个数是最小的,第三个数是第二大的,第四个数是第二小的.....以此类推
$a = array(12,65,110,2,3,55,79,10,45);
$count = count($a);
for($i=0;$i<$count;$i++){
	if($i%2==0){
		$z = max($a);
		$key = array_search($z, $a);//这个函数是根据值,取出键
		echo $z." ";
		unset($a[$key]);//数组中删除这个值;
	}else{
		$z = min($a);
		$key = array_search($z, $a);
		echo $z." ";
		unset($a[$key]);
	}
}
        1. foo()和@foo()之间有什么区别
        @foo() 是错误控制输出，foo()是正常调用输出。@符号在PHP 中可以忽略错误报告，对于表达式有提示错误的，但又不影响语句执行的，可以在表达式之前加@。可以把@符号放在变量、函数和include()  调用、常量等之前，但不能把@放在函数、类的定义之前，也不能用于条件结构语句之前
        eg：if 、switch、while、for和foreach等
        2. 使用list()函数需要注意什么
        list()函数是用数组对一列值进行赋值,该函数只用于数字索引的数组，且假定数字索引从0开始
        <?php
        $arr=array(
        "1"=>"book",
        "3"=>"pen",
        "5"=>"paper"
        );
        list($a,$b,$c)=$arr;这样的话是不对的只能是$b有值,是book,其他无值
         
        3.php操作文件的常用函数
        basename返回路径中的文件名部分
        dirname返回路径中的目录部分
        pathinfo — 返回文件路径的信息
        filetype();--取得文件类型
        stat() --给出文件的信息
        filesize();--取得文件大小
        echo __FILE__;（发回文件的相关路径和文件名信息）
        echo __DIR__;返回路径信息，不返回文件名
         
        3. 三个数求出最大值,不用max函数,用三元运算符
        function test($a,$b,$c){
        return $a > $b ?($a > $c ? $a : $c) : ($b > $c ? $b :$c);
        }
        4. 如何调用父类中的同名方法
        Parent::方法名();
         
        5.$this,self,parent的用法
        $this：当前对象
        self： 当前类
        parent： 当前类的父类
        $this在当前类中使用,使用->调用属性和方法。
        self也在当前类中使用，不过需要使用::调用。
        静态属性，不能在类里使用$this访问，应该使用self后跟范围解析操作符(::),后面是带着美元符号的变量名。
         
        5. php中的PECL是什么
        是php的扩展仓库
        安装方法yum install php-pear
        用法
        搜索模块pecl search extension
        安装模块pecl install  extension
         
        6. 实现一个函数,一个字符串中另一个字符串出现的次数
        Substr_count(字符串,子串,开始位置,长度);
         * */

//7. php实现消息队列
//class Deque
//{
//    public $queue = array();
//    /**（尾部）入队 **/
//    public function addLast($value)
//    {
//        return array_push($this->queue,$value);
//    }
//    /**（尾部）出队**/
//    public function removeLast()
//    {
//                    return array_pop($this->queue);
//    }
//    /**（头部）入队**/
//    public function addFirst($value)
//    {
//                    return array_unshift($this->queue,$value);
//    }
//    /**（头部）出队**/
//    public function removeFirst()
//    {
//                    return array_shift($this->queue);
//    }
//    /**清空队列**/
//    public function makeEmpty()
//    {
//                    unset($this->queue);
//                }
//    /**获取列头**/
//    public function getFirst()
//    {
//                    return reset($this->queue);
//    }
//
//    /** 获取列尾 **/
//    public function getLast()
//    {
//                    return end($this->queue);
//    }
//
//    /** 获取长度 **/
//    public function getLength()
//    {
//                    return count($this->queue);
//    }
//}

        /*
         8. 简述你知道的数据结构和特点
        双向队列数据结构
        队列运算包括
        　　（1）入队运算：从队尾插入一个元素；
        　　（2）退队运算：从队头删除一个元素。
         
        9. 用5种方法取出数组的第一个元素
        (1) Array_shift($arr);  (2)array_slice($arr,0,1) (3)reset($arr);  (4)current($arr)  (5)$a = array_values($arr);  $a[0];
        10. 说明ajax同步和异步的区别
        -同步：提交请求->等待服务器处理->处理完毕返回 这个期间客户端浏览器不能干任何事
        异步: 请求通过事件触发->服务器处理（这时浏览器仍然可以作其他事情）->处理完毕  
         * */

        /*
         13. 从一个标准url中取出文件扩展名,例如:
        http://tbk.726p.com/abc/de/fg.php?id=1#laowen
         取出php或.php
        echo pathinfo( parse_url($url)['path'] )['extension'];
        echo pathinfo( parse_url( $url, PHP_URL_PATH ), PATHINFO_EXTENSION );
        解释 :
        parse_url($url);会输出
        Array
        (
            [scheme] => http
            [host] => tbk.726p.com
            [path] => /abc/de/fg.php
            [query] => id=1
            [fragment] => laowen
        )
        我们需要 parse_url($url)['path']来获取/abc/de/fg.php
        Pathinfo(‘/abc/de/fg.php’);会输出
        Array
        (
            [dirname] => /abc/de
            [basename] => fg.php
            [extension] => php
            [filename] => fg
        )
        所以Pathinfo(‘/abc/de/fg.php’)[’’extension’;会输出php
         
        14. 写一个匹配邮箱的正则,匹配手机号的正则
        15. 常用设计模式
        策略模式,工厂模式,单例模式,注册模式,适配器模式,观察者模式
        16. 简述http协议
        1)客户端与服务器需要建立连接
        2)建立连接后，客户端发送一个请求给服务器
        3)服务器接到请求后，给予相应的响应信息
        4)客户端接收服务器返回的信息并显示在用户的显示屏上，然后客户端机与服务器断开连接
         
        17. 几种常用的排序算法
        18. Xss攻击,sql防注入
        xss攻击 常指黑客通过“HTML注入”篡改网页，插入恶意的脚本，从而在用户浏览网页时，控制用户浏览器的一种攻击。
        将重要的cookie标记为http only,   这样的话Javascript 中的document.cookie语句就不能获取到cookie了.
        只允许用户输入我们期望的数据。 例如：　年龄的textbox中，只允许用户输入数字。 而数字之外的字符都过滤掉。
        对数据进行Html Encode 处理
        过滤或移除特殊的Html标签， 例如: <script>, <iframe> ,  < for <, > for >, " for
        过滤JavaScript 事件的标签。例如 "onclick=", "onfocus" 等等。
         
        CSRF攻击（跨站点请求伪造）：顾名思义，是伪造请求，冒充用户在站内的正常操作
        通过session token来实现保护。当客户端请求页面时，服务器会生成一个随机数Token，并且将Token放置到session当中，然后将Token发给客户端（一般通过构造hidden表单）。下次客户端提交请求时，Token会随着表单一起提交到服务器端。接收到请求后，服务器端会对Token值进行验证，判断是否和session中的Token值相等，若相等，则可以证明请求有效，不是伪造的。
         
        sql防注入 : 数字条件用intval() 2.字符串变量,用addslashes()会把所有单引号,双引号,反斜线,和空字符串转为含有反斜线的溢出字符
         
        19. 伪静态的理解
        20. 如何获取客户端的ip和服务器端的ip
        $_SERVER['REMOTE_ADDR'] 客户端IP，有可能是用户的IP，也可能是代理的IP。
        $_SERVER['SERVER_ADDR'] 获取服务器端IP
        21. 如果打开网页的时候白屏10秒才显示出页面,如何进行排查
        方法一
        断点调试法，下断点从入口一步步追踪下去，比如入口第一行秒回 则 下面行，二分查找速度 快些，主观判断哪里慢10秒很容易查出来，这种前提是要下要几次断点
        方法二
        用xhprof xdebug 等侵入式分析工具安装php 扩展 XHPROF, 先 分析下 php性能瓶颈, 然后在查dns, 服务器带宽,cpu, 内存
        22. 请写一段php代码,确保多个进程同时写入同一个文件成功
        23. Php开始和结束标记
        <?php ?>   <% %>  <?  ?>    <script language="php">  </script>
        24. include和require的区别
        require：这个函数一般放在PHP文件的最前面，程序在执行前就会先导入要引用的文件,一个文件存在错误时，执行就会中断。并返回一个致命错误。
        include：这个函数一般放在程序的流程控制里边。只有程序在执行碰到才会引用一个文件存在错误，程序不会中断执行。会弹出一个警告
        include_once（require_once）需要查询一遍已加载的文件列表, 确认是否存在, 然后再加载
         
        25. isset和empty
        Isset
        若变量不存在则返回 FALSE 
        若变量存在且其值为NULL，也返回 FALSE 
        若变量存在且值不为NULL，则返回 TURE 
        Empty
        若变量不存在则返回 TRUE 
        若变量存在且其值为""、0、"0"、NULL、、FALSE、array()、var $var; 以及没有任何属性的对象，则返回 TURE 
        若变量存在且值不为""、0、"0"、NULL、、FALSE、array()、var $var; 以及没有任何属性的对象，则返回 FALSE 
         
        26. CGI,FastCGI,php-fpm的概念和区别

        27. 写出将一个数组里的空值去掉的语句
$array1 = array('  ',1,'',2,3);
print_r(array_filter($array1, "del"));
function del($var)
{
       return(trim($var));
}
 
28.写出获取当前时间戳的函数，及打印前一天的时间的方法(格式：年-月-日 时:分:秒)
12Time();Date(“Y-m-d H:i:s”,Strtotime(“-1 day”));

        28. mysql锁,mysql优化.mysql索引
sql语句优化 避免在列上用函数去运算,会导致索引失效,使用like时候尽量避免用%%,不要selet *,虽然速度上不会有影响,但是节省内存,尽量使用批量插入,不要循环插入,不适用rand去获取随机记录,避免使用null,不要使用conut(id,)而是count(*),尽量在索引中完成排序
mysql服务器优化 : 关闭不必要的二进制日志和慢查询日志,增加mysql的最大链接数,删除大量行后,可运行OPTIMIZE TABLE TableName进行碎片整理
最重要的是增加服务器CUP数量和内存的大小
 
左联右脸写法
SELECT a.runoob_id, a.runoob_author, b.runoob_count FROM runoob_tbl a INNER JOIN tcount_tbl b ON a.runoob_author = b.runoob_author;
 
Union用法
UNION 语句：用于将不同表中相同列中查询的数据展示出来；（不包括重复数据）
UNION ALL 语句：用于将不同表中相同列中查询的数据展示出来；（包括重复数据）
SELECT country FROM Websites UNION SELECT country FROM apps ORDER BY country;
 
Having用法 :
SELECT dept,COUNT(user_name) count_tmp FROM ec_uses GROUP BY dept HAVING count_tmp>1;

Redis和memcached
1. Redis和Memcache都是将数据存放在内存中，都是内存数据库。不过memcache还可用于缓存其他东西，例如图片、视频等等。 
2、Redis不仅仅支持简单的k/v类型的数据，同时还提供list，set，hash等数据结构的存储。 
3、分布式–设定memcache集群，利用magent做一主多从;redis可以做一主多从。都可以一主一从 
4、存储数据安全–memcache挂掉后，数据没了；redis可以定期保存到磁盘（持久化） 
5、灾难恢复–memcache挂掉后，数据不可恢复; redis数据丢失后可以通过aof恢复 
6、Redis支持数据的备份，即master-slave模式的数据备份。
 
Redis的持久化 : 内存快照 + 日志追加


        xss攻击(php教程) ： https://www.w3school.com.cn/php/php_form_validation.asp
htmlspecialchars() 函数把特殊字符转换为 HTML 实体。这意味着 < 和 > 之类的 HTML 字符会被替换为 &lt; 和 &gt; 。这样可防止攻击者通过在表单中注入 HTML 或 JavaScript 代码（跨站点脚本攻击）对代码进行利用。还有一个函数叫htmlspecialchars_decode()是解开html实体
在用户提交该表单时，我们还要做两件事：
1（通过 PHP trim() 函数）去除用户输入数据中不必要的字符（多余的空格、制表符、换行）
2（通过 PHP stripslashes() 函数）删除用户输入数据中的反斜杠（\）


        文件操作
1。readfile('文件名');

2。文件操作函数
$myfile = fopen("test.txt", "r");//打开文件（打开文件模式有人r，w，a，x，r+，w+，a+，x+，文档在下面）
echo fread($myfile,filesize("test.txt"));//读取文件,第一个参数是fopen打开的文件资源，第二个参数规定待读取的最大字节数(指针会移动到最后一行，这时候用feof还是显示false)
//feof($myfile);//feof() 函数检查是否已到达 "end-of-file" (EOF),如果没有到最后，则返回flase
while(!feof($myfile)) {
    echo fgets($myfile) . "<br>";//用于从文件读取单行，调用 fgets() 函数之后，文件指针会移动到下一行
}
while(!feof($myfile)) {
    echo fgetc($myfile);//fgetc() 函数用于从文件中读取单个字符,在调用 fgetc() 函数之后，文件指针会移动到下一个字符
}
$txt = "Mickey Mouse\n";
fwrite($myfile, $txt);//写入文件，第一个参数是fopen打开的文件资源，第二个参数是被写的字符串
fclose($myfile);//关闭文件，节省服务器资源


        OSI七层网络模型(从下往上)：
物理层(Physical)：
数据链路层(Datalink)：
网络层(Network)：IP协议就在这一层！
传输层(Transport)：TCP传输控制协议与UDP用户数据报协议
会话层(Session)：
表示层(Presentation)：
应用层(Application)：
端口:
1. 用于区分不同的应用程序
2. 端口号的范围为0-65535，其中0-1023为系统的保留端口，我们的程序尽可能别使用这些端口！
3. IP地址和端口号组成了我们的Socket，Socket是网络运行程序间双向通信链路的终结点， 是TCP和UDP的基础！
4. 常用协议使用的端口：HTTP:80，FTP：21，TELNET：23
         * */


        /*
         一.面向对象 :
1.构造方法(实例化类时,第一个调用的方法)   function __construct(参数,参数,...){}
在php5以前的版本中,构造方法的方法名称必须与类名相同,而现在,如果一个类中没有__construct方法,php将搜索与类名相同名的构造方法执行.

2.析构方法(对象被销毁前自动调用的方法)    function __destruct(){}
析构方法不可以有参数
对象的引用都是存放在栈内存中,栈有后进先出的特点(细说php第143页有这个例子,很有意思)

3.function __set($name,$value)   (在外部给私有属性赋值是会报错的,但是有了__set这个方法,也可以在外部给私有属性赋值,会直接调用这个方法)
使用时 : $a = new a();
 $a->name = value;(这样,私有属性name,就被赋值为value)
可以在__set方法里加一些判断的限制,可以避免给私有属性赋了不正确的值(例:细说php第149页)

4.function __get($name)  (在外部调用私有属性时,自动调用这个方法,这个方法里可以根据需要返回私有属性的值)  (例:细说php第150页)

5.继承(extends)  class a extends b{}

6.private(只能在本类中使用)    protected(能在本类和子类中使用)    public(本类,子类,外部都可使用)
在子类中重写了父类方法后,也可以通过parent::方法名在子类中使用父类中被重写的方法

7.final关键字  (final关键字不能放在成员属性前)
例: final class a{}  (final放在类之前,则这个类不能被继承)
      final public function a(){}   (final放在成员方法之前,则这个方法不能被重写)

8.static关键字 (static是静态,可以修饰成员属性和成员方法)
用static修饰的属性和方法是属于类的,所以在外部可以不用实例化就可以访问,在外部访问的方法是 类名::成员属性(成员方法)   例:  bao::$name;        bao::talk;        如果实例化了,可以使用也可以使用例如$a->talk()这样调用成员方法,但是却不可以这样调用成员属性
在类的内部,可以使用self::talk(),这种方法调用成员属性和成员方法,不可以使用$this->这种方法调用静态属性,但可以这样使用静态的成员方法
给static修饰的成员属性赋值时候,成员属性会一直保存着,而没用static修饰的成员属性,每一次都会重置
例如 :
class Human{
     public $name1=0;
     public static $name2=0;

     public function __construct()
     {
         $this->name1 = $this->name1 + 1;
         self::$name2 = self::$name2 + 1;
     }
}

$a = new Human();
$a = new Human();
$a = new Human();
echo $a->name1;//这里输出1
echo Human::$name2;//这里输出3

9.const关键字(给成员属性定义常量)
在类中给成员属性定义常量 : 例  const BAO='bao';   在设置时,不要使用$符,而且常量要大写,而且必须有值,因为常量不能被再赋值,
再类内部使用时,例  self::BAO;    在类外部使用时   类名::BAO;

10.克隆对象
例 $a = new a(); 当实例化一个类时 $b = clone $a;  则$a和$b相同,都可以调用成员方法和成员属性
但是有一点,使用clone克隆对象时,在类中会调用魔术方法 __clone,不需要也传不了参数,可以在__clone中重新给成员属性赋值,或者做一些其他操作

11.魔术方法 __toString
在实例化一个类时  例 $a = new a();   如果echo $a;的话时会报错的
但是类中有 __toString时, echo $a,就会输出__toString中返回的字符串,而且__toString中必须return一个字符串,否则会报错

12.魔术方法 __call($a,$b)   这个魔术方法是,当在外部调用类里没有的方法时,自动调用这个魔术方法
这个魔术方法必须有两个参数,第一个参数是你要调用的,却在类里没有的方法名,第二个参数是你给这个方法传的参数(放在数组里)

13.自动加载类的魔术方法  __autoload
例:
<?php
function __autoload($className){//这个魔术方法不是写在类里
include(strtolower($className).".class.php");
}
$a = new a();//当该文件中没有a这个类时,自动调用__autoload这个方法,并将a这个类名当做参数传给__autoload这个方法,所以就可以引入a.class.php这个文件了

14.interface的使用  和 implements的使用
interface usb{//定义了接口,使用implements去继承usb的时候,里面的接口必须都实现
    const brand = 'siemens';    // 接口的属性必须是常量
    public function connect();  // 接口的方法必须是public【默认public】，且不能有函数体
}
// new usb();  // 接口不能实例化

// 类实现接口
class Android implements usb{
    public function connect(){  // 类必须实现接口的所有方法
        echo '实现接口的connect方法';
    }
}

15.abstract的使用
//作用：抽象类不实现具体方法，具体方法由子类完成。
//定义抽象类 abstract
abstract class A{
  //abstract 定义抽象类的方法，这里没有花括号。子类必须实现这个抽象方法。
  abstract public function say();
  //抽象类可以有参数
  abstract public function eat($argument);
  //在抽象类中可以定义普通的方法。
  public function run(){
    echo '这是run方法';
  }
}
class B extends A{
  //子类必须实现父类的抽象方法，否则是致命的错误。
  public function say(){
    echo '这是say方法,实现了抽象方法';
  }
  public function eat($argument){
    echo '抽象类可以有参数 ，输出参数：'.$argument;
  }
}
$b =new B;
$b->say();
echo '<br>';
$b->eat('apple');
echo '<br>';
$b->run();

16.use的使用 : use还可以用在闭包函数中，代码如下 (https://blog.csdn.net/aarontong00/article/details/53792601)
<?php
function test() {
$a = 'hello';
return function ($a)use($a) {
        echo $a . $a;
    };
}
$b = test();
$b('world');//结果是hellohello
当运行test函数，test函数返回闭包函数，闭包函数中的use中的变量为test函数中的$a变量，当运行闭包函数后，输出“hellohello”,由此说明函数体中的变量的优先级是:use中的变量的优先级比闭包函数参数中的优先级要高
         * */

        /*
         NGINX负载均衡
https://www.cnblogs.com/doublexi/p/9680215.html
https://blog.csdn.net/mengyuanxi/article/details/80344721
https://www.cnblogs.com/jn1011/p/10595351.html

nginx支持的负载均衡调度算法方式如下：
weight轮询（默认）：接收到的请求按照顺序逐一分配到不同的后端服务器，即使在使用过程中，某一台后端服务器宕机，nginx会自动将该服务器剔除出队列，请求受理情况不会受到任何影响。 这种方式下，可以给不同的后端服务器设置一个权重值（weight），用于调整不同的服务器上请求的分配率；权重数据越大，被分配到请求的几率越大；该权重值，主要是针对实际工作环境中不同的后端服务器硬件配置进行调整的。

ip_hash：每个请求按照发起客户端的ip的hash结果进行匹配，这样的算法下一个固定ip地址的客户端总会访问到同一个后端服务器，这也在一定程度上解决了集群部署环境下session共享的问题。

fair：智能调整调度算法，动态的根据后端服务器的请求处理到响应的时间进行均衡分配，响应时间短处理效率高的服务器分配到请求的概率高，响应时间长处理效率低的服务器分配到的请求少；结合了前两者的优点的一种调度算法。但是需要注意的是nginx默认不支持fair算法，如果要使用这种调度算法，请安装upstream_fair模块

url_hash：按照访问的url的hash结果分配请求，每个请求的url会指向后端固定的某个服务器，可以在nginx作为静态服务器的情况下提高缓存效率。同样要注意nginx默认不支持这种调度算法，要使用的话需要安装nginx的hash软件



        sql注入问题 : 在PHP中的 mysqli_query() 是不允许执行多个 SQL 语句的，但是在 SQLite 和 PostgreSQL 是可以同时执行多条SQL语句的，所以我们对这些用户的数据需要进行严格的验证
防止SQL注入，我们需要注意以下几个要点：
1.永远不要信任用户的输入。对用户的输入进行校验，可以通过正则表达式，或限制长度；对单引号和 双"-"进行转换等。
2.永远不要使用动态拼装sql，可以使用参数化的sql或者直接使用存储过程进行数据查询存取。
3.永远不要使用管理员权限的数据库连接，为每个应用使用单独的权限有限的数据库连接。
4.不要把机密信息直接存放，加密或者hash掉密码和敏感的信息。
5.应用的异常信息应该给出尽可能少的提示，最好使用自定义的错误信息对原始错误信息进行包装
6.sql注入的检测方法一般采取辅助软件或网站平台来检测，软件一般采用sql注入检测工具jsky，网站平台就有亿思网站安全平台检测工具。MDCSOFT SCAN等。采用MDCSOFT-IPS可以有效的防御SQL注入，XSS攻击等。
like查询时，如果用户输入的值有"_"和"%"，则会出现这种情况：用户本来只是想查询"abcd_"，查询结果中却有"abcd_"、"abcde"、"abcdf"等等；用户要查询"30%"（注：百分之三十）时也会出现问题。
在PHP脚本中我们可以使用addcslashes()函数来处理以上情况
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
        if (isset($a)) {
            echo '成功1';
        } else {
            echo '失败1';
        }

        if (empty($a)) {
            echo '成功2';
        } else {
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

    public function suanfa10(Request $request) {
        /*
            有一个背包,最多放入10KG,希望在负重范围内放入价值最大的组合,以下是所有物品(物品可重复选择)
            电脑  7KG  $9500
            ipad  3KG   $4000
            手机  2KG  $2000
            手表  1KG  $1500
            鼠标  5KG  $8000
            游戏机  6KG  $7500
         * */
        //背包承重上限
        $limit = 10;
        //物品种类
        $total = 6;
        //物品
        $array = [
            ["笔记本电脑", 7, 9500],
            ["ipad", 3, 4000],
            ["手机", 2, 2000],
            ["手表", 1, 1500],
            ["鼠标", 5, 8000],
            ["游戏机", 6, 7500],
        ];
        //存放物品的数组
        $item = array_fill(0, $limit + 1, 0);
        //存放价值的数组
        $value = array_fill(0, $limit + 1, 0);
        for ($i = 0; $i < $total; $i++) {
            for ($j = $array[$i][1]; $j <= $limit; $j++) {
                $p        = $j - $array[$i][1];
                $newvalue = $value[$p] + $array[$i][2];
                //找到最优解的阶段
                if ($newvalue > $value[$j]) {
                    $value[$j] = $newvalue;
                    $item[$j]  = $i;
                }
            }
        }
        echo "物品  价格<br />";
        for ($i = $limit; 1 <= $i; $i = $i - $array[$item[$i]][1]) {
            echo $array[$item[$i]][0] . "  " . $array[$item[$i]][2] . "<br />";
        }
        echo "合计  " . $value[$limit];
    }

    public function subwayPay(Request $request) {
        date_default_timezone_set('Asia/Shanghai');
        $name    = strval($request->input('name'));
        $ticket  = intval($request->input('ticket'));
        $date    = strval($request->input('date'));
        $days    = intval($request->input('days'));
        $message = strval($request->input('message'));
        if (!isset($name) || mb_strlen($name) > 20) return '姓名有误';
        if (!isset($ticket) || $ticket < 3 || $ticket > 9) return 'ticket有误';
        if ($days) {
            if ($days < 1 || $days > 31) return 'days有误';
        };

        //判断日期是否正确
        $riqi = explode('-', $date);
        if (!$riqi[0] || !$riqi[1]) return '日期有误';
        $year  = intval($riqi[0]);
        $month = intval($riqi[1]);
        if ($year < 1970 || $year > 9900) return '年有误';
        if ($month < 1 || $month > 12) return '月有误';
        //end

        $now = date('Y-m-d H:i:s', time());
        $id  = DB::table('subwayUse')->insertGetId(
            ['inputtime' => $now, 'name' => $name, 'ticket' => $ticket, 'date' => $date, 'days' => $days, 'message' => $message]
        );


        $worksdays = $this->workDays($year, $month);
        $enjoy50   = 0;
        $enjoy80   = 0;
        $total     = 0;
        for ($i = 1; $i <= $worksdays * 2; $i++) {
            if ($total >= 150) {
                if ($total < $ticket + 150) $enjoy50 = $i;
                $total = bcadd($total, bcmul($ticket, 0.5, 5), 2);
            } elseif ($total >= 100) {
                if ($total < $ticket + 100) $enjoy80 = $i;
                $total = bcadd($total, bcmul($ticket, 0.8, 5), 2);
            } else {
                $total = bcadd($total, $ticket, 2);
            }
        }
        $dateData = ['ticket' => $ticket, 'days' => $worksdays, 'enjoy80' => $enjoy80 / 2, 'enjoy50' => $enjoy50 / 2, 'total' => $total];


        $dayData = [];
        if ($days) {
            $enjoy50 = 0;
            $enjoy80 = 0;
            $total   = 0;
            for ($i = 1; $i <= $days * 2; $i++) {
                if ($total >= 150) {
                    if ($total < $ticket + 150) $enjoy50 = $i;
                    $total = bcadd($total, bcmul($ticket, 0.5, 5), 2);
                } elseif ($total >= 100) {
                    if ($total < $ticket + 100) $enjoy80 = $i;
                    $total = bcadd($total, bcmul($ticket, 0.8, 5), 2);
                } else {
                    $total = bcadd($total, $ticket, 2);
                }
            }
            $dayData = ['ticket' => $ticket, 'days' => $days, 'enjoy80' => $enjoy80 / 2, 'enjoy50' => $enjoy50 / 2, 'total' => $total];
        }
        return view('subway.subwayShow', ['dateData' => $dateData, 'dayData' => $dayData, 'name' => $name, 'date' => $date, 'id' => $id]);

    }

    public function workDays($year, $month) {
        $day          = 1;
        $days         = 0;
        $t            = mktime(0, 0, 0, $month, $day, $year);
        $days         = date('t', $t);
        $fristDayWeek = date('w', $t);//每月一号的星期数
        $lastDayWeek  = date('w', mktime(0, 0, 0, $month, $days, $year));//每月最后一天的星期数
        if ($days > 28) {//非平年二月算法，平年二月无论怎么都只有20天。
            if ($fristDayWeek == 6)//起始日是星期六的减去2天，星期天的减去一天。
                $days -= 2;
            if ($fristDayWeek == 0)
                $days -= 1;
            if ($lastDayWeek == 6)//结束日是星期六的减去一天，星期天的减去2天。
                $days -= 1;
            if ($lastDayWeek == 0)
                $days -= 2;
        }

        if ($days < 28)//每个月最少会工作20天，此处修正开始日期是星期六，结束日期是星期天的31天的月份

            $days = 28;
        return $days - 8;// 减去每个月都有的4个星期天共8天
    }

    public function forKobe(Request $request) {
        date_default_timezone_set('Asia/Shanghai');
        $id   = $request->input('id');
        $talk = $request->input('talk') ? $request->input('talk') : '无';
        $data = DB::table('subwayUse')->where(['id' => $id])->value('id');
        //var_dump($data);die;
        if ($data) {
            DB::table('subwayUse')
                ->where('id', $id)
                ->update(['talk' => $talk]);
        } else {
            $now = date('Y-m-d H:i:s', time());
            DB::table('subwayUse')->insertGetId(
                ['inputtime' => $now, 'talk' => $talk]
            );
        }
        return view('subway.subwayIndex');
    }

    //定时任务
    public function crontab() {
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
    public function huancun() {
        //https://blog.csdn.net/kongtiao5/article/details/82771694
    }

    //字符串函数
    public function string() {
        $str  = '11223344556677889900';
        $str2 = "This is some &lt;b&gt;bold&lt;/b&gt; text.";
        $str3 = "This is some < >";
        $arr  = ['Hello', 'World!', 'Beautiful', 'Day!'];

        $test = strlen("Hello");//字符串长度
        $test = mb_strlen("菜鸟教程");//中文字符串长度

        $test = explode('@', $str3);//字符串转数组
        $test = implode(" ", $arr);//数组转字符串
        $test = join(" ", $arr);//数组转字符串,同implode

        $test = str_ireplace("WORLD", "Peter", "Hello world!");//str_ireplace() 函数替换字符串中的一些字符（不区分大小写）。
        $arr  = ["blue", "red", "green", "yellow", 'red'];
        var_dump(str_ireplace("RED", "pink", $arr, $i)); //str_ireplace()也可以对数组进行替换,它将对数组中的每个元素进行查找和替换(注意必须是一维数组,如果是二维的话不能替换),返回的是一个数组,$i代表替换了多少个值
        $test = str_replace("world", "Peter", "Hello world!");//str_replace() 函数替换字符串中的一些字符（区分大小写）。
        $arr  = ["blue", "red", "green", "yellow", 'red'];
        var_dump(str_replace("red", "pink", $arr, $i)); //str_replace()也可以对数组进行替换,它将对数组中的每个元素进行查找和替换(注意必须是一维数组,如果是二维的话不能替换),返回的是一个数组,$i代表替换了多少个值

        $test = ltrim($str3, "This");//移除字符串左侧的空白字符或其他预定义字符。
        $test = rtrim($str3, "< >");//移除字符串右侧的空白字符或其他预定义字符。
        $test = trim($str3, "< >");//移除字符串两侧的空白字符或其他预定义字符。

        $test = strcasecmp("Hello", "HELLO");//strcasecmp();比较两个字符串(不区分大小写),比较两个字符串(不区分大小写),相等返回0   如果 string1 小于 string2则返回小于0(如果字符串前面相等,那么谁长度长就大)
        $test = strcmp("Hello", "HELLO");//strcmp();比较两个字符串(区分大小写),相等返回0   如果 string1 小于 string2则返回小于0(小于的含义是如果字符串前面相等,那么谁长度长就大,如果前面不一样,那么小写的比较大,不管长度多少,返回的基本是长度,而不是1或-1)
        $test = strncasecmp("Hello world!", "hello earth!", 6);//strncasecmp()前 n 个字符的字符串比较（不区分大小写）。
        $test = strncmp("Hello world!", "hello earth!", 6);//strncmp()前 n 个字符的字符串比较（区分大小写）。

        $test = substr("Hello world", 6, 3);//截取字符串
        $test = mb_substr("菜鸟教程", 0, 2);//截取中文字符串
        $test = substr_count("Hello world. The world is nice", "world");//计算子串在字符串中出现的次数。(区分大小写)
        $test = substr_replace("Hello", "world", 2);//函数把字符串的一部分替换为另一个字符串。

        $test = chunk_split($str, 2, '@');//用字符串去分割字符串,返回分割好的字符串
        $test = str_split("Hello", 2);//str_split() 函数把字符串分割到数组中。

        $test = strchr("Hello world!123", "world", true);//(区分大小写)查找 "world" 在 "Hello world!" 中是否存在，如果是，返回该第一次出现该字符串及后面(或前面,由true和false空值)剩余部分,如果不存在则返回false  同strstr
        $test = strrchr("Hello world!", "world");//函数查找字符串在另一个字符串中最后一次出现的位置，并返回从该位置到字符串结尾的所有字符。
        $test = strstr("Hello world!123", "world", true);//(区分大小写)查找 "world" 在 "Hello world!" 中是否存在，如果是，返回该字符串及后面(或前面,由true和false空值)剩余部分,如果不存在则返回false
        $test = stristr("Hello world!", "WORLD");//(不区分大小写)查找 "world" 在 "Hello world!" 中是否存在，如果是，返回该字符串及后面(或前面,由true和false空值)剩余部分,如果不存在则返回false

        $test = stripos("I love php too!", "PHP");//stripos() 函数查找字符串在另一字符串中第一次出现的位置（不区分大小写）。
        $test = strpos("I love php too!", "php");//查找字符串在另一字符串中第一次出现的位置（区分大小写）。
        $test = strripos("I love php too!", "PHP");//查找字符串在另一字符串中最后一次出现的位置（不区分大小写）。
        $test = strrpos("I love php too!", "php");//查找字符串在另一字符串中最后一次出现的位置（区分大小写）。

        $test = lcfirst("Hello world!");//首字母小写
        $test = ucfirst("hello world!");//首字母大写
        $test = ucwords("hello world");//把字符串中每个单词的首字符转换为大写。
        $test = strtolower("Hello WORLD.");//所有字符转换为小写：
        $test = strtoupper("Hello WORLD!");//所有字符转换为大写：

        $test = str_pad($str, 25, ".");//str_pad() 函数把字符串填充为新的长度,默认在右侧填充,也可以选择左侧和两侧
        $test = str_repeat("abc", 13);//str_repeat() 函数把字符串重复指定的次数。
        $test = str_shuffle("Hello World");//函数随机地打乱字符串中的所有字符。
        $test = strrev("Hello World!");//反转字符串
        $test = str_word_count("Hello world!");//str_word_count() 函数计算字符串中的单词数。

        $test = addcslashes($str, "11");//addcslashes() 函数返回在指定的字符前添加反斜杠的字符串。注意,不管传的是1还是11,返回的字符串都是\1\1
        $test = addslashes('What does "yolo" mean\?');//addslashes() 函数返回在预定义的字符前添加反斜杠的字符串。(预定义字符包括:单引号（'）双引号（"）反斜杠（\）NULL)
        $test = bin2hex("Hello World!");//bin2hex() 函数把 ASCII 字符的字符串转换为十六进制值。字符串可通过使用 pack() 函数再转换回去。
        $test = chop($str);//chop() 函数移除字符串右侧的空白字符或其他预定义字符。注意:第二个参数必须是从要删除的字符串尾部开始往前的某个字符串,如果是中间的某个字符串,则不删除原样返回,如果第二个参数为空,则删除"\0" - NULL  "\t" - 制表符  "\n" - 换行  "\x0B" - 垂直制表符  "\r" - 回车  " " - 空格
        $test = chr(65);//chr() 从指定 ASCII 值返回字符。
        $test = ord("hello");//ord() 函数返回字符串中第一个字符的 ASCII 值。(注意是字符串的第一个字符,不管字符串多长)

        $test = htmlspecialchars_decode($str2);//函数把一些预定义的 HTML 实体转换为字符。比如 : &lt; 解码成 < （小于）
        $test = htmlspecialchars($str3);//htmlspecialchars() 函数把一些预定义的字符转换为HTML实体 比如 : < （小于）成为 &lt;
        $test = get_html_translation_table(HTML_ENTITIES); //函数返回 htmlentities() 和 htmlspecialchars() 函数使用的翻译表。(返回的是一个数组,具体看函数文档)

        $test = md5('a');//md5() 函数计算字符串的 MD5 散列。
        $test = md5_file("test.txt");//md5_file() 函数计算文件的 MD5 散列。
        echo number_format("1000000", 3);//number_format() 函数通过千位分组来格式化数字。
        printf("There are %u million bicycles in %s.", 1, 'Beijing');//printf() 函数输出格式化的字符串。
        $test = sha1($str);//sha1() 函数计算字符串的 SHA-1 散列。
        $test = sha1_file("test.txt");//sha1_file() 函数计算文件的 SHA-1 散列。
        $test = strip_tags("Hello <b>world!</b>");//strip_tags() 函数剥去字符串中的 HTML、XML 以及 PHP 的标签。


        var_dump($test);
        //var_dump($str);
    }

    //数组函数
    public function arr() {
        $arr  = ['a' => "Volvo", "BMW", 'b' => "Toyota", "Honda", 'c' => "Mercedes", "Opel", '1', '2', 'a', 'A'];
        //var_dump($arr);
        $arr2 = [['a' => 'a', 'b' => 'b'], ['c' => 'c', 'd'], ['e', 'f']];
        $a1   = ["a" => "red", "b" => "green", "c" => "blue", "d" => "yellow"];
        $a2   = ["e" => "red", "f" => "green", "g" => "blue"];

        $test = array_slice($arr2, 1, 2);//截取数组(跟截取字符串相似)
        $test = array_splice($a1, 1, 0, $a2);//截取a1数组并用a2数组替换,如果长度是0的话就意味着插入
        $test = array_rand($arr2,3);//随机获取固定数量的数组中的key,如果获取1个则返回字符串或int,如果是多个那么返回数组
        $test = count($arr2);//返回数组中元素的数目。可以递归查询多维数组
        $test = sizeof($arr2);//同count

        $test = array_fill(3, 4, "blue");//函数用给定的键值填充数组。(第一个参数是key从几开始,第二个参数是填充几个,第三个参数是value)
        $test = array_fill_keys(['a', 'b'], "blue");//用指定的key填充数组
        $test = array_pad($arr, 20, "blue");//使用某个值填充数组,填充到固定数组指定长度,如果数组长度已经超过指定长度,则数组不会被填充,如果指定长度为负数,那么会在数组前面填充

        arsort($arr);//函数对关联数组按照value进行降序排序。(保留key)
        asort($arr);//函数对关联数组按照value进升序排序。(保留key)
        krsort($arr);//对关联数组按照key进行降序排序。
        ksort($arr);//函数对关联数组按照key进行升序排序
        rsort($arr);//函数对数值数组进行降序排序。(也可对字符串数组进项排序)(不保留key)
        sort($arr);//函数对数值数组进行升序排序。(也可对字符串数组进项排序)(不保留key)
        array_multisort($arr);//对数组中的字符串进行排序,数字>大写>小写,可以传多个数组

        $test = current($arr); //函数返回数组中的内部指针指向的当前元素的值。
        $test = pos($arr); //同current
        $test = reset($arr);//将内部指针指向数组中的第一个元素，并输出。
        $test = end($arr);//数将内部指针指向数组中的最后一个元素，并输出。
        $test = next($arr);//将内部指针指向数组中的下一个元素，并输出(如果指针到最后一个,再使用next则返回false)
        $test = prev($arr);//将内部指针指向数组中的上一个元素，并输出。(如果指针到第一个,再使用prev则返回false)
        $test = key($arr);//从当前内部指针位置返回元素键名。

        $test = array_unshift($arr,"blue");//在数组开头插入一个或多个元素。
        $test = array_shift($arr);//删除数组中的第一个元素，并返回被删除的元素。(如果键名是数字的，所有元素都将获得新的键名，从 0 开始，并以 1 递增)
        $test = array_push($arr,"blue");//将一个或多个元素插入数组的末尾（入栈）。返回的是数组元素数
        $test = array_pop($arr);//删除数组中的最后一个元素（出栈）。返回的是呗删除的元素

        $test = array_flip(['a', 'a', 'a']);//key和value对换
        $test = array_key_exists("Volvo", $arr);//判断数组中某个key是否存在,返回true和false
        $test = array_search("Volvo", $arr);//在数组中搜索某个value，并返回对应的键名。失败返回false(搜索的value可以是数组)
        $test = array_keys($arr);//返回一个一维数组,包含所有key
        $test = array_values($arr);//返回包含数组中所有的值的数组。(key从0开始)
        $test = array_count_values($arr);//统计数组中所有值出现的次数。(返回的是一个值为key,次数为value的一维数组)

        $test = array_change_key_case(["Peter" => "35", "Ben" => "37", "Joe" => "43"], CASE_UPPER);//数组的所有的键都转换为大写字母或小写字母。
        $test = array_chunk($arr, 2);//array_chunk() 函数把一个数组分割为新的数组块。(一维数组变二维,二维变三维,注意:一维数组变二维时候键是不保留的,但是多维变的时候是带key的)

        $a    = [
            [
                'id'         => 5698,
                'first_name' => 'Peter',
                'last_name'  => 'Griffin',
            ],
            [
                'id'         => 4767,
                'first_name' => 'Ben',
                'last_name'  => 'Smith',
            ],
            [
                'id'         => 3809,
                'first_name' => 'Joe',
                'last_name'  => 'Doe',
            ],
        ];
        $test = array_column($a, 'last_name');//返回输入数组中某个单一列的值。(数据库查询时候基本是二维数组包含的多条数据,所以可以这样取出每条数据中的某个字段)

        $fname = ["Peter", "Ben", "Joe"];
        $age   = ["35", "37", "43"];
        $test  = array_combine($fname, $age);//合并两个数组来创建一个新数组，其中的一个数组元素为键名，另一个数组的元素为键值。(注意,两个数组元素数必须相同)


        $test = array_diff($a1, $a2);//比较数组，返回两个数组的差集（只比较value）。
        $test = array_diff_assoc($a1, $a2);//比较数组，返回两个数组的差集（key和value同时比较,必须都相等）。
        $test = array_diff_key($a1, $a2);//比较数组，返回两个数组的差集（只比较key）。
        $test = array_intersect($a1, $a2);//比较数组，返回两个数组的交集（只比较value）。
        $test = array_intersect_assoc($a1, $a2);//比较数组，返回两个数组的交集（key和value同时比较,必须都相等）。
        $test = array_intersect_key($a1, $a2);//比较数组，返回两个数组的差集（只比较key）。

        $test = array_merge([1 => 'a', 2 => 'b'], ['a' => 'a', 'b' => 'b']);//合并两个数组,如果只传一个数组,且key是整数,那么新数组会重新计算key从0开始,如果两个数组的key相同,那么后面的会覆盖前面的
        $test = array_merge_recursive(['a' => 'a', 'b' => 'b'], ['a' => 'a', 'b' => 'b']);//合并两个数组,如果只传一个数组,且key是整数,那么新数组会重新计算key从0开始,如果两个数组的key相同,那么会将两个value组成一个数组,键是相同的key
        $test = array_replace($a1, $a2);//两个数组通过键来替换,如果第二个数组的键不存在与第一个数组,那么会在返回的数组中创建这个key=>value
        $test = array_replace_recursive($a1, $a2);//函数递归地使用后面数组的值替换第一个数组的值。

        $test = extract(["a" => "Cat","b" => "Dog", "c" => ['x','y']]);//使用数组key作为变量名，使用数组value作为变量值。针对数组中的每个元素，将在当前符号表中创建对应的一个变量(该函数返回成功设置的变量数目)
        list($a, $b, $c) = ['dog','cat','fuck'];//用于在一次操作中给一组变量赋值。数组必须是索引数组
        $test = in_array(['e', 'f'], $arr2);//判断元素是否在数组中,返回true和false
        $test = shuffle($arr);//随机打乱数组,不保留key。成功返回true
        $test = array_reverse($arr);//返回翻转顺序的数组。(第二个参数可以传true和false,控制key是否保留数字的key,如果key是字符串那么不受影响)
        $firstname = "Peter";
        $lastname = "Griffin";
        $age = [41];
        $test = compact("firstname", "lastname", "age");//创建一个包含变量名和它们的值的数组。变量名必须存在

        $test = array_product([1,2,3]);//计算数组内元素的乘积,如果是字符串那么会变成数字去计算,传二维数组是无效的
        $test = array_sum([1,2,'3','4abc']);//计算数组内元素的和,如果是字符串那么会变成数字去计算,传二维数组是无效的
        $test = array_unique($arr); //函数用于移除数组中重复的值。如果两个或更多个数组值相同，只保留第一个值，其他的值被移除。


        $test = array_filter($arr, function ($val) {//使用回调函数来过滤想要过滤的值
            if ($val === 0 || $val != false) {
                return true;
            } else {
                false;
            }
        });
        $test = array_filter([0, '', null, false, [], 'a']);//如果不传回调函数,那么就是过滤空值(0,'',null,false,[]都会被过滤)


        $test = array_map(function ($v1, $v2)//使用函数来处理一个或多个数组,将返回值组成一个新数组返回
        {
            if ($v1 === $v2) {
                return "same";
            }
            return "different";
        }, $arr, $arr2);

        $test = array_reduce($arr,function($v1,$v2){//使用回调函数,对数组中的每个值进行处理,返回一个字符串(多用于拼接字符串或计算或者其他处理),第三个参数是规定发送到函数处理的第一个值。
            return $v1.'@'.$v2;
        },'xxx');


        var_dump($arr);
    }


}