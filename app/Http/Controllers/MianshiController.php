<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\True_;

class MianshiController extends Controller {

    public function mianshiti(){
        /*
         mysql索引,btree如二叉树一样，每次查询都是从树的入口root开始，依次遍历node，获取leaf。Hash 索引像键值对一样,仅仅能满足"=","IN"和"<=>"查询，不能使用范围查询。
        为什么 B+ Tree 索引会降低新增、修改、删除的速度
        B+ Tree 是一颗平衡树，如果对这颗树新增、修改、删除的话，会破坏它的原有结构；
        我们在做数据新增、修改、删除的时候，需要花额外的时间去维护索引；
        正因为这些额外的开销，导致索引会降低新增、修改、删除的速度。
         * */
        /*
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
         NGINX负载均衡
https://www.cnblogs.com/doublexi/p/9680215.html
https://blog.csdn.net/mengyuanxi/article/details/80344721
https://www.cnblogs.com/jn1011/p/10595351.html

nginx支持的负载均衡调度算法方式如下：
weight轮询（默认）：接收到的请求按照顺序逐一分配到不同的后端服务器，即使在使用过程中，某一台后端服务器宕机，nginx会自动将该服务器剔除出队列，请求受理情况不会受到任何影响。 这种方式下，可以给不同的后端服务器设置一个权重值（weight），用于调整不同的服务器上请求的分配率；权重数据越大，被分配到请求的几率越大；该权重值，主要是针对实际工作环境中不同的后端服务器硬件配置进行调整的。

ip_hash：每个请求按照发起客户端的ip的hash结果进行匹配，这样的算法下一个固定ip地址的客户端总会访问到同一个后端服务器，这也在一定程度上解决了集群部署环境下session共享的问题。

fair：智能调整调度算法，动态的根据后端服务器的请求处理到响应的时间进行均衡分配，响应时间短处理效率高的服务器分配到请求的概率高，响应时间长处理效率低的服务器分配到的请求少；结合了前两者的优点的一种调度算法。但是需要注意的是nginx默认不支持fair算法，如果要使用这种调度算法，请安装upstream_fair模块

url_hash：按照访问的url的hash结果分配请求，每个请求的url会指向后端固定的某个服务器，可以在nginx作为静态服务器的情况下提高缓存效率。同样要注意nginx默认不支持这种调度算法，要使用的话需要安装nginx的hash软件

         * */

    }

    public function question_1(){
        /*
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

        18. Xss攻击,sql防注入
        xss攻击 常指黑客通过“HTML注入”篡改网页，插入恶意的脚本，从而在用户浏览网页时，控制用户浏览器的一种攻击。
        将重要的cookie标记为http only,   这样的话Javascript 中的document.cookie语句就不能获取到cookie了.
        只允许用户输入我们期望的数据。 例如：　年龄的textbox中，只允许用户输入数字。 而数字之外的字符都过滤掉。
        对数据进行Html Encode 处理
        过滤或移除特殊的Html标签， 例如: <script>, <iframe> ,  < for <, > for >, " for
        过滤JavaScript 事件的标签。例如 "onclick=", "onfocus" 等等。
         
        CSRF攻击（跨站点请求伪造）：顾名思义，是伪造请求，冒充用户在站内的正常操作
        通过session token来实现保护。当客户端请求页面时，服务器会生成一个随机数Token，并且将Token放置到session当中，然后将Token发给客户端（一般通过构造hidden表单）。下次客户端提交请求时，Token会随着表单一起提交到服务器端。接收到请求后，服务器端会对Token值进行验证，判断是否和session中的Token值相等，若相等，则可以证明请求有效，不是伪造的。
         

        xss攻击(php教程) ： https://www.w3school.com.cn/php/php_form_validation.asp
htmlspecialchars() 函数把特殊字符转换为 HTML 实体。这意味着 < 和 > 之类的 HTML 字符会被替换为 &lt; 和 &gt; 。这样可防止攻击者通过在表单中注入 HTML 或 JavaScript 代码（跨站点脚本攻击）对代码进行利用。还有一个函数叫htmlspecialchars_decode()是解开html实体
在用户提交该表单时，我们还要做两件事：
1（通过 PHP trim() 函数）去除用户输入数据中不必要的字符（多余的空格、制表符、换行）
2（通过 PHP stripslashes() 函数）删除用户输入数据中的反斜杠（\）
         * */



        /*
        web安全知识
        xss攻击 常指黑客通过“HTML注入”篡改网页，插入恶意的脚本，从而在用户浏览网页时，控制用户浏览器的一种攻击。
        将重要的cookie标记为http only,   这样的话Javascript 中的document.cookie语句就不能获取到cookie了.
        只允许用户输入我们期望的数据。 例如：　年龄的textbox中，只允许用户输入数字。 而数字之外的字符都过滤掉。
        对数据进行Html Encode 处理
        过滤或移除特殊的Html标签， 例如: <script>, <iframe> ,  &lt; for <, &gt; for >, &quot for
        过滤JavaScript 事件的标签。例如 "onclick=", "onfocus" 等等。

        CSRF攻击（跨站点请求伪造）：顾名思义，是伪造请求，冒充用户在站内的正常操作
        通过session token来实现保护。当客户端请求页面时，服务器会生成一个随机数Token，并且将Token放置到session当中，然后将Token发给客户端（一般通过构造hidden表单）。下次客户端提交请求时，Token会随着表单一起提交到服务器端。接收到请求后，服务器端会对Token值进行验证，判断是否和session中的Token值相等，若相等，则可以证明请求有效，不是伪造的。
         * */
    }

    public function question_2(){
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
    }

    public function question_3(){
        /*
             文件操作
                1。readfile('文件名');

                2。文件操作函数
                $myfile = fopen("test.txt", "r");//打开文件（打开文件模式有人r，w，a，x，r+，w+，a+，x+，文档在下面）
                echo fread($myfile,filesize("test.txt"));读取文件,第一个参数是fopen打开的文件资源，第二个参数规定待读取的最大字节数(指针会移动到最后一行，这时候用feof还是显示false)

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
         * */

        /*
        php操作文件的常用函数
        basename返回路径中的文件名部分
        dirname返回路径中的目录部分
        pathinfo — 返回文件路径的信息
        filetype();--取得文件类型
        stat() --给出文件的信息
        filesize();--取得文件大小
        echo __FILE__;（发回文件的相关路径和文件名信息）
        echo __DIR__;返回路径信息，不返回文件名
         * */
    }

    public function question_4(){
        //1.解释一下命令 : top,rm,ll,mkdir,chgrp
        //2.修改dir目录的权限为任何人可以访问,并设置所有者为Apache
        //3.linux一般在编译并安装由C语言所编写的软件共有几步,写出每步的命令
        //4.关闭防火墙
        //5.static如何使用
        //6.php中的pecl是什么,有什么用途
        //7.件数CGI,FastCGI和php-fpm的概念和区别
        //8.件数你知道的数据结构及特点
        //9.http协议状态码304,302,403,404
        //10.实现一个双向队列,完成基本的数据插入弹出操作
        //11.有一堆数字$arr=[12,65,110,2,3,55,79,10,45]等很多数字并且没有重复的,要求是:输出第一个数是最大的,第二个数是最小的,第三个数是第二大的,第四个数是第二小的...依次类推
        //12.写一个函数,尽可能高效的从一个标准url里取出文件的扩展名,例如:http://tbk.726p.com/abc/de.fg.php?id=1,需要取出php或.php
        //13.伪静态的理解
        //14.获取客户端ip和服务端ip  $_SERVER['REMOTE_ADDR'] $_SERVER['SERVER_ADDR']
        //15.一个三角形三个顶点有3只老鼠,一声枪响,3只老鼠开始沿三角形的边匀速运动,请问他们相遇的概率是
        //16.有一母牛,到4岁可生育,每年一头,所生均是一样的母牛,到15岁绝育,不能再生,20岁死亡,问n年后有多少头牛
    }

    public function question_5(){
        //mysql的explain
        /*
        EXPLAIN : https://blog.csdn.net/eagle89/article/details/89516496
        EXPLAIN :模拟Mysql优化器是如何执行SQL查询语句的，从而知道Mysql是如何处理你的SQL语句的，分析你的查询语句或是表结构的性能瓶颈。
        explain显示了mysql如何使用索引来处理select语句以及连接表。可以帮助选择更好的索引和写出更优化的查询语句
        Explain中各字段的解释 :
        1.id : select查询的数字序列号，表示查询中执行select子句、或多表联合查询时操作表、的顺序；id相同，执行顺序由上至下,id不同，id越大执行优先级越高
        2.select_type :
                ·（1）SIMPLE  简单查询，查询中不包含子查询、union（联合查询）；
                ·（2）PRIMARY  查询中若包含子查询，则最外层查询被标记为PRIMARY；
                ·（3）SUBQUERY  在select或where列表中的子查询
                ·（4）DERIVED  典型语法：from ( 子查询 ) s1， 在from列表中包含的子查询，被标记为DERIVED（衍生），这个子查询执行后的结果集放在一张虚表s1中；
                ·（5）UNION  若第二条select出现在union之后，则标记为union联合多表查询； 若union包含在from字句的查询中，即select 属性 from（子查询1 union 子查询2）s1，这种外层的select被标记为DERIVED；
                · （6）UNION RESULT  从UNION表中获取结果的SELECT
        3.table : 指id对应的表，通过id判断表的执行顺序；也指这一行的数据是关于哪张表的；
        4.type : 显示查询时，使用了哪种查询类型，日常工作中经常接触到的有以下7种，性能由最好到最差依次是：system > const > eq_ref > ref > range > index > ALL,一般需要保证查询类型等级达到range，最好能达到ref，避免使用ALL。
        5.possible_keys : 查询的字段上若存在索引，则将索引列出，一个或多个，但不一定在查询时实际使用；
        6.key : 实际使用的索引，若为NULL，则没有使用索引，常见的可能原因：没有建索引,sql语句写法错误，索引失效,possible_key也为NULL时，表示用不到索引
        7.key_len : 可以通过key_len看出索引字段的个数，74指1个，78指2个，140指3个；
        8.ref : 显示使用索引的是哪个字段，可以是一个const常量；ps：type里的ref指非唯一索引扫描，对索引字段，可能存在多个重复值；
        9.rows : 索引查询时，大致估算出查询到所需记录读取的行数，rows越小越好；
        10.Extra
                额外信息，包含以下三种：
                · （1）Using filesort
                说明建立的、准备使用的索引index并没有被用到，执行了文件排序；
                可能是sql语句写法有问题，与之前建立的索引index冲突了；

                · （2）Using temporary
                使用了临时表来保存中间结果，说明建立的索引没有使用完全；
                常见于排序order by和分组查询group by；

                · （3）Using index
                select操作中用到了覆盖索引（Covering Index），说明sql执行的效率不错！
                覆盖索引（Covering Index）：
                eg：先creat一个index，index_字段a_字段b；
                然后select 字段a，字段b on table where 字段a=…，字段b=…
                即先创建拥有某几个字段的索引，然后查询索引里的字段，where列表是索引字段的值；即当索引字段值为XXX时，查询该字段；这是select效率最高的方式。
                ··· 若同时出现using where，表明索引被用来执行索引键值的查找；
                ··· 若没有同时出现using where，表明索引没有用来执行索引键值的查找，只是用来读取数据；


        索引命中 : https://www.jianshu.com/p/499cf5795de5 (最左侧a=某某，后面列大于小于无所谓，都使用索引（但后面必须 and and ）,但是a>这种不行,中间带or不行,单独使用b,c不行)
         * */
    }

    public function question_6(){
        //redis处理秒杀
        /*
        1.预生成库存数量的订单rpush
        2.用户下单请求,使用lpop取出订单,并存入hash,状态为未支付
        3.如果不能取出订单,则表示库存已使用完,显示秒杀失败
        4.如果用户支付,则将hash中对应的订单状态改为已支付,如果用户未支付超时或者取消订单,则订单状态改为取消,然后预生成订单重新添加,让用户可以继续秒杀
        5.秒杀结束后,将所有redis订单取出,定时任务存入数据库
         * */
    }

    public function question_7(){
        //cookie和session
        /*
        1.cookie和session原理及区别   
            cookie是服务器在本地机器上存储的小段文本或者是内存中的一段数据，并随每一个请求发送至同一个服务器。cookie信息是以请求头的方式发送到服务器端的：
            session是一种服务器端的信息管理机制，它把这些文件信息以文件的形式存放在服务器的硬盘空间上,当客户端向服务器发出请求时，要求服务器端产生一个session时，服务器端会先检查一下，客户端的cookie里面有没有session_id，是否过期。如果有这样的session_id的话，服务器端会根据cookie里的session_id把服务器的session检索出来。如果没有这样的session_id的话，服务器端会重新建立一个。PHPSESSID是一串加了密的字符串，它的生成按照一定的规则来执行。同一客户端启动二次session_start的话，session_id是不一样的。 
            区别：Cookie保存在客户端浏览器中，而Session保存在服务器上。Cookie机制是通过检查客户身上的“通行证”来确定客户身份的话，那么Session机制就是通过检查服务器上的“客户明细表”来确认客户身份。Session相当于程序在服务器上建立的一份客户档案，客户来访的时候只需要查询客户档案表就可以了。

        2.session产生的session_id放在cookie里面，如果用户把cookie禁止掉，是不是session也不能用了呢？
            禁止掉cookie后，session当然可以用，不过通过其他的方式来获得这个sessionid，比如，可以跟在url的后面，或者以表单的形势提交到服务器端。从而使服务器端了解客户端的状态。

         * */
    }

    public function question_8(){
        //微信支付
        /*
        准备 : 商户需要拥有一个微信支付商户号，并通过超级管理员账号登陆商户平台，获取商户API证书。商户API证书的压缩包中包含了签名必需的私钥和商户证书。
        1.构造签名串 :
            HTTP请求方法\n
            URL\n
            请求时间戳\n
            请求随机串\n
            请求报文主体\n
        2.计算签名值 : 使用商户私钥对待签名串进行SHA256 with RSA签名，并对签名结果进行Base64编码得到签名值。
        3.设置HTTP头 :
            (1).认证类型，目前为WECHATPAY2-SHA256-RSA2048
            (2).签名信息
            发起请求的商户（包括直连商户、服务商或渠道商）的商户号 mchid
            商户API证书serial_no，用于声明所使用的证书
            请求随机串nonce_str
            时间戳timestamp
            签名值signature

         * */
    }


}


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