<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller {
    /**
     * 常用总结
     *
     * @param  int $id
     *
     */
    public function mysqlCS() {
        //mysql主从,索引,事务锁,分库分表


        /*
         linux重启mysql服务 :
         service mysqld start (5.0版本是mysqld)   service mysql start (5.5.7版本是mysql)
         service mysqld stop
         service mysqld restart
         或者
         1.启动：/etc/init.d/mysqld start    /etc/init.d/mysql restart
         2.停止：/etc/init.d/mysqld stop
         3.重启：/etc/init.d/mysqld restart

         macos重启mysql
         1、启动mysql sudo /usr/local/mysql/support-files/mysql.server start
         2、停止mysql sudo /usr/local/mysql/support-files/mysql.server stop
         3、重启mysql sudo /usr/local/mysql/support-files/mysql.server restart

         * */

        /*
         如果在服务器自己安装mysql的时候,如果连接不上而且报这个错Can't connect to local MySQL server through socket '/var/lib/mysql/mysql.sock' (2),这个是因为远程mysql没有启动,打命令/etc/init.d/mysqld start.此时本地可能还是连不上远程数据库,是因为用户权限的问题,在服务器上连接数据库(mysql -u root -p),然后select user,host from mysql.user;查看一下各个账号的权限,只有host为%的才能远程连接,而host为localhost的账号只能本地连接,然后打命令修改权限1.GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'admin123' WITH GRANT OPTION; 2.flush privileges; 3.exit 打完之后退出,然后重启mysql服务/etc/init.d/mysqld restart (此时外部已经可以连接上远程mysql,如果再报错)
         * */



        /*mysql语法顺序
        (7) SELECT
        (8) DISTINCT <select_list>
        (1) FROM <left_table>
        (3) <join_type> JOIN <right_table>
        (2) ON <join_condition>
        (4) WHERE <where_condition>
        (5) GROUP BY <group_by_list>
        (6) HAVING <having_condition>
        (9) ORDER BY <order_by_condition>
        (10) LIMIT <limit_number>
         * */


        //总结1. : 使用 or 会使索引会失效，在数据量较大的时候查找效率较低，通常建议使用 union 代替 or。union有distinct 功能,union all是不筛选重复,会有两条重复记录

        //总结2. : 多条件判断语句
        //SELECT *, CASE WHEN (x + y > z) AND (x + z > y) AND (y + z > x) THEN 'Yes' ELSE 'No' END AS triangle FROM triangle
        //select *,IF(x + y > z AND x + z > y AND y + z > x, 'Yes', 'No') as triangle FROM triangle;

        //总结3.select min(abs(a.x-b.x)) from point a join point b on a.x<>b.x  abs函数是获取绝对值

        //总结4.select * from cinema where mod(id, 2) = 1  //mod(id,2)=1 是奇数的意思,取余  我用的id%2=1也是可以通过的1

        //总结5.ROUND(AVG(b.experience_years),2)  round四舍五入保留2位小数,avg求平均数

        //总结6.成绩排序问题非常非常重要  使用rank()over()遇到成绩相同时候是像这样排序1-2-2-4  而dense_rank()over()函数成绩相同时候是这样排序1-2-2-3  而row_number()over()即使有成绩相同那也是1-2-3-4这么排序
        //select s.*,rank() over(order by s.total desc) as ranks from (select SId,sum(score) as total from SC group by SId) s

        /*总结 : 如果有时间可以看一下
        lag(exp_str,offset,defval) over(partition by ..order by …)
        lead(exp_str,offset,defval) over(partition by ..order by …)
        */

        //如果有员工表,每个员工对应的团队有团队id,想查询每个员工和其对应的团队有多少人,可以使用count(*)over(partition by 字段)来查询,非常方便
        //重要 : 当你group by分组查询时候,你可能只想查询分组的字段,和count()条数,而其他字段是有特殊性的没办法显示在结果集中,但是用GROUP_CONCAT(DISTINCT 字段 ORDER BY 字段) AS 名称 这个函数可以将你想要的字段拼接成一个字符串显示在结果集中,比如这个group_concat中先用了distinct去重你想要的字段,然后order by排序你的字段然后命名了一个名称,这样结果集中就有用逗号分隔的字符串了 (group_concat(字段 separator ';')这样写就是以分号分割结果字符串)

        //总结7.
        /*
         1、LEFT()函数是一个字符串函数，它返回具有指定长度的字符串的左边部分。
        　　LEFT(Str,length);
        　　接收两个参数：str：一个字符串；length：想要截取的长度，是一个正整数；
        2、REVERSE(Str)：翻转，这个函数可以将字符串翻转；SELECT REVERSE(LEFT('2019-01-30',4));取前4位并翻转。
        3、日期函数
        　　3.1、SELECT DATE_FORMAT(CURDATE(),'%Y%m');// 扩展 NOW(),CURDATE(),CURTIME()   这三个函数分别显示为 2008-12-29 16:25:46,2008-12-29,16:25:46
        　　结果为当前年和月：201901
            select date_format(now(),'%Y-%m-%d %H:%i:%s')  可以按要求合理使用
            select unix_timestamp(now()); 或者 select unix_timestamp(); 获取时间戳
            select from_unixtime(1515980716, '%Y-%m-%d %H:%i:%S'); 时间戳格式化
        　　3.2、SELECT CURRENT_TIMESTAMP;
        　　结果为当前日期及时间：2019-01-29 23:59:31
        　　3.3、SELECT CURRENT_TIME;
        　　结果为当前时间：23:59:31
        　　3.4、SELECT CURRENT_DATE;
        　　结果为当前日期：2019-01-29
         * */

        /*总结8.
        mysql正则 : SELECT * FROM users WHERE mail REGEXP '^[A-Z][A-Z0-9_.-]*@leetcode.com$';
        */

        /*
         总结9.SELECT LOWER(TRIM(product_name)) AS product_name   其中LOWER是小写的意思,TRIM是清除两边空格的意思
         拓展 : SELECT TRIM(LEADING 'x' FROM 'xxxbarxxx');   --删除指定的首字符 x
               SELECT TRIM(BOTH 'x' FROM 'xxxbarxxx');      --删除指定的首尾字符 x
                SELECT TRIM(TRAILING 'xyz' FROM 'barxxyz');  --删除指定的尾字符 x
        */

        /*总结9.
        cross join 笛卡尔积  注意：cross join的时候是不需要on或者using关键字的，这个是区别于inner join和join的
         * */

        /*
         总结10  pow(a,2)是a的2次方   sqrt()开平方
         * */

        /*
         总结11 使用in关键字的时候,可以in两个字段d
        select product_id,`year` first_year,quantity,price from Sales where (product_id,year) in (select product_id,min(year) from Sales group by product_id)
         * */

        /*
         总结12 如果使用left join on的时候,希望left表的一些数据返回null,则某些条件可以在on中写,如果在where中写的话是不返回的,而on中写可以返回null,如果这些数据是需要用到的话
         * */

        /*
         总结13  sum(order_date = customer_pref_delivery_date)  sum中可以写判断,如果判断成立则+1否则不加,但是不能count()中加判断,因为是数数,所以查询的是这个条件查了多少遍,所以判断没用
         * */

        /*
         总结14  SELECT PERSON_NAME, SUM(WEIGHT) OVER(ORDER BY TURN DESC) AS TOTAL_WEIGHT FROM QUEUE    sum(字段)over(order by 字段) 这样查询会把所有条数都查出来,对应每条数据的sum 注意:over中必须有order by 否则会查询sum总值而不是没条对应的值
         * */

        /*
         4.mysql数据库分区+分表
        分区 : 所谓分区,就是把一个数据表的文件和索引分散存储在不同的物理文件中.mysql5.1及以上版本才支持分区      https://www.cnblogs.com/mliudong/p/3625522.html(分区教程+示例)
        查看mysql是否支持分区的命令  :  SHOW VARIABLES LIKE '%partition%'  (这个命令仅仅支持mysql5.6以下的版本)   如果显示 | have_partitioning | YES | 则为支持分区
                                                              show plugins;(如果是msyql5.6以上版本应该用这个命令去查看)    会显示所有插件，如果找到有：partition ACTIVE STORAGE ENGINE GPL  则为支持分区

        RANGE分区 : 基于属于一个给定连续区间的列值，把多行分配给分区。这些区间要连续且不能相互重叠，使用VALUES LESS THAN操作符来进行定义。以下是实例。优点是使查询效率变高
        注意 : 如果想要将id变为主键自增,则用来做分区的字段也必须为主键用于做分区表的列必须是主键，或包含于主键中

        注意 : 如果想要重建分区并保留数据,没有这样的操作,只能是建立一个新的表,做好分区,然后将数据转移到新的表中(所以设计表时候应该慎重)

        添加分区的语句:(注意:1.当分区中有最大值MAXVALUE的时候,是不能加分区的会报错 2.加分区时,只能从最大值往后加分区,而不能往最大值前加分区,会报错,所以想要用分区要先设计好程序,设计好表)
        ALTER TABLE 表名 ADD PARTITION(PARTITION 分区名 VALUES LESS THAN (条件))

        删除分区的语句: (注意,删除分区会同时删除分区中的数据,慎重!!)
        ALTER TABLE 表名 DROP PARTITION 分区名;

        建表实例1 : 根据store_id字段分区
        CREATE TABLE t2(
            id INT NOT NULL,
            fname VARCHAR(30),
            lname VARCHAR(30),
            hired DATE NOT NULL DEFAULT '1970-01-01',
            separated DATE NOT NULL DEFAULT '9999-12-31',
            job_code INT NOT NULL,
            store_id INT NOT NULL
        )
        PARTITION BY RANGE (store_id) (
            PARTITION p0 VALUES LESS THAN (6),
            PARTITION p1 VALUES LESS THAN (11),
            PARTITION p2 VALUES LESS THAN (16),
            PARTITION p3 VALUES LESS THAN MAXVALUE
        );

        建表实例2 : 根据年份separated分区
        CREATE TABLE employees (
            id INT NOT NULL,
            fname VARCHAR(30),
            lname VARCHAR(30),
            hired DATE NOT NULL DEFAULT '1970-01-01',
            separated DATE NOT NULL DEFAULT '9999-12-31',
            job_code INT,
            store_id INT
        )

        PARTITION BY RANGE (YEAR(separated)) (
            PARTITION p0 VALUES LESS THAN (1991),
            PARTITION p1 VALUES LESS THAN (1996),
            PARTITION p2 VALUES LESS THAN (2001),
            PARTITION p3 VALUES LESS THAN MAXVALUE
        );

        几种获取MySQL分区表信息的常用方法
        SHOW CREATE TABLE + 表名 可以查看创建分区表的CREATE语句
        EXPLAIN PARTITIONS SELECT * from +表名 查看select语句怎样使用分区 

        LIST分区优点(不常用) : 便于删除
        CREATE TABLE employees (
            id INT NOT NULL,
            fname VARCHAR(30),
            lname VARCHAR(30),
            hired DATE NOT NULL DEFAULT '1970-01-01',
            separated DATE NOT NULL DEFAULT '9999-12-31',
            job_code INT,
            store_id INT
        )

        PARTITION BY LIST(store_id)
            PARTITION pNorth VALUES IN (3,5,6,9,17),
            PARTITION pEast VALUES IN (1,2,10,11,19,20),
            PARTITION pWest VALUES IN (4,12,13,14,18),
            PARTITION pCentral VALUES IN (7,8,15,16)
        );
         * */

    }

    //配置主从
    public function zhucong(){
        /*
            mysql主从配置步骤 :
            1、主从服务器分别作以下操作：1.1、版本一致  1.2、初始化表，并在后台启动mysql
            2、修改主服务器master配置文件:
                #vi /etc/my.cnf
               [mysqld]
               log-bin=mysql-bin   //[必须]启用二进制日志
               server-id=222      //[必须]服务器唯一ID，默认是1(在配置文件中搜索server-id,应该在中间左右)
            3、修改从服务器slave:
               #vi /etc/my.cnf
               [mysqld]
               log-bin=mysql-bin   //[不是必须]启用二进制日志
               server-id=226      //[必须]服务器唯一ID，默认是1(在配置文件中搜索server-id,应该在中间左右)
            4、重启两台服务器的mysql : /etc/init.d/mysql restart
            5、在主服务器上建立帐户并授权slave:
               #/usr/local/mysql/bin/mysql -uroot -p
               mysql>GRANT REPLICATION SLAVE ON *.* to '账号'@'%' identified by '密码'; //一般不用root帐号，%表示所有客户端都可能连，只要帐号，密码正确，此处可用具体客户端IP代替，如192.168.145.226，加强安全。
            6、登录主服务器的mysql，查询master的状态(这两个值在第7步使用)
               mysql>show master status;
               +------------------+----------+--------------+------------------+
               | File             | Position | Binlog_Do_DB | Binlog_Ignore_DB |
               +------------------+----------+--------------+------------------+
               | mysql-bin.000004 |      308 |              |                  |
               +------------------+----------+--------------+------------------+
               1 row in set (0.00 sec)
               注：执行完此步骤后不要再操作主服务器MYSQL，防止主服务器状态值变化
            7、配置从服务器Slave：
       mysql>change master to master_host='192.168.145.222',master_user='mysync',master_password='q123456',master_log_file='mysql-bin.000004',master_log_pos=308;//注意不要断开，308数字前后无单引号。
               Mysql>start slave;    //启动从服务器复制功能(如果之前已经有slave,那么会报错,需要先stop slave在start slave)
                这里可以 select user,host from mysql.user;查看一下各个账号的权限,只有host为%的才能远程连接,而host为localhost的账号只能本地连接,
            8、检查从服务器复制功能状态：
               mysql> show slave status\G
               *************************** 1. row ***************************
                          Slave_IO_State: Waiting for master to send event
                          Master_Host: 192.168.2.222  //主服务器地址
                          Master_User: mysync   //授权帐户名，尽量避免使用root
                          Master_Port: 3306    //数据库端口，部分版本没有此行
                          Connect_Retry: 60
                          Master_Log_File: mysql-bin.000004
                          Read_Master_Log_Pos: 600     //#同步读取二进制日志的位置，大于等于Exec_Master_Log_Pos
                          Relay_Log_File: ddte-relay-bin.000003
                          Relay_Log_Pos: 251
                          Relay_Master_Log_File: mysql-bin.000004
                          Slave_IO_Running: Yes    //此状态必须YES
                          Slave_SQL_Running: Yes     //此状态必须YES
                                ......
            注：Slave_IO及Slave_SQL进程必须正常运行，即YES状态，否则都是错误的状态(如：其中一个NO均属错误)。
            以上操作过程，主从服务器配置完成。



            使用主从同步的好处：
            通过增加从服务器来提高数据库的性能，在主服务器上执行写入和更新，在从服务器上向外提供读功能，可以动态地调整从服务器的数量，从而调整整个数据库的性能。
            提高数据安全-因为数据已复制到从服务器，从服务器可以终止复制进程，所以，可以在从服务器上备份而不破坏主服务器相应数据
            在主服务器上生成实时数据，而在从服务器上分析这些数据，从而提高主服务器的性能


            注意 : 经测试,在同步后的从服务器上新建了一条数据,那么主从同步失效了,进入从服务器mysql使用show slave status\G查看从服务器的状态,显示Slave_SQL_Running:NO,此时需要stop slave,然后start slave,主从同步恢复,新加的数据可以同步,但是从服务器的数据是变化了的,从服务器上之前的数据会缺失,所以从服务器要设置成只读(只读设置set global read_only=1; )
            注意 : 主从成功配置后,可以再主数据库使用show slave hosts来查看有几个从数据库
            注意 : 当主数据库有数据时候,要先导出数据 1.flush tables with read lock;(设置锁只能读) 2.mysqldump -uroot -p --master-data=1 --single-transaction --routines --triggers --events  --all-databases > all.sql导出数据库所有数据或者mysqldump -uroot -p'123456' -S /data/3306/data/mysql.sock --all-databases | gzip > /server/backup/mysql_bak.$(date +%F).sql.gz来压缩数据量很大的数据库 3.将sql文件导入到从数据库中 4.unlock tables;解锁主数据库


            主从排错 :
            1.show variables like 'server_id';可以用来查看主数据库和从数据库的server_id,各个数据库的server_id都不能重复 ,如果有重复的,那么从服务器在查看show slave status\G时候会报Slave_IO_Running: NO,这样不行
            如果这个从数据库已经start salve了,那么想重新设置的时候要先stop slave,否则不能成功

            2.如果Slave_IO_Running:NO 那么下面会有报错,Last_IO_Error: Fatal error: The slave I/O thread stops because master and slave have equal MySQL server ids; these ids must be different for replication to work (or the --replicate-same-server-id option must be used on slave but this does not always make sense; please check the manual before using it). 这个错误是主从的server-id相等了,我做的时候是在上面新加了一个server-id,但是下面有server-id=1,所以覆盖了,不新加而改下面的server-id即可

            3.苹果电脑是没有配置文件my.cny的,要自己创建
            change master to master_host='116.62.167.242',master_user='zhucong',master_password='bao1ning123',master_log_file='mysql-bin.000011',master_log_pos=154;


             * */
    }

    //事务
    public function shiwu(){
        //1.首先要记住,innodb在隔离级别为RR(可重复度的情况下)是可以解决脏读,不可重复读,幻读的
        //2.死锁 : 死锁简单说就是，线程1拿A锁等B锁，同时线程2拿B锁等A锁   解决:发生死锁时，InnoDB一般都能通过算法（wait-for graph）自动检测到。第一个事务中，检测到了死锁，马上退出，第二个事务获得了锁
        /*
         3.悲观锁包括 : 共享锁/排他锁（行级别读/写锁）  意向共享锁/意向排他锁（表级别读/写锁）
                       其中行锁算法包括 : 记录锁  间隙锁  临键锁
           乐观锁 : 乐观锁机制通过在表中添加version字段进行实现。在Mysql InnoDB引擎中，其会在每行数据中额外添加两个隐藏值来实现MVCC，这两个值一个记录这行数据何时被创建，另外一个记录这行数据何时更新(或者被删除)。在实际操作中，每开启一个新事务，事务的版本号就                    会递增
         * */
        /*
         原子性（Atomicity）：事务是一个原子操作单元。在当时原子是不可分割的最小元素，其对数据的修改，要么全部成功，要么全部都不成功。
        一致性（Consistent）：事务开始到结束的时间段内，数据都必须保持一致状态。
        隔离性（Isolation）：数据库系统提供一定的隔离机制，保证事务在不受外部并发操作影响的”独立”环境执行。
        持久性（Durable）：事务完成后，它对于数据的修改是永久性的，即使出现系统故障也能够保持。
         * */
    }

    //索引
    public function suoyin(){
        /*
         索引
            普通索引：仅加速查询
            唯一索引：加速查询 + 列值唯一（可以有null）
            主键索引：加速查询 + 列值唯一（不可以有null）+ 表中只有一个(表中只能有一个主键,但这个主键可以是多个字段,称为联合主键)
            ps 主键：用PRIMARY KEY修饰的列。若只有一个主键，则其不能重复。若存在两个或多个主键，则为复合主键(也就是多个列可以组成复合主键)；此时，只有当组成复合主键的所有列的值都相同时，才不允许(把多个列同时重复才视为重复)。
            组合索引：多列值组成一个索引，专门用于组合搜索，其效率大于索引合并
            全文索引：对文本的内容进行分词，进行搜索


            （abc） （ab） （ac）（bc）（a） （b） （c） (注意最左原则)
              1. 复合索引又叫联合索引。
              2. abc    ab    a     ac  可以
              3. 对于复合索引:Mysql从左到右的使用索引中的字段，一个查询可以只使用索引中的一部份，但只能是最左侧部分。
              4. 例如索引是key index (a,b,c). 可以支持a | a,b| a,b,c 3种组合进行查找，但不支持 b,c进行查找 ,当最左侧字段是常量引用时，索引就十分有效。


             索引查询失效的几个情况：(索引失效分析工具：可以使用explain命令加在要分析的sql语句前面，在执行结果中查看key这一列的值，如果为NULL，说明没有使用索引。)
                1、like 以%开头，索引无效；当like前缀没有%，后缀有%时，索引有效。
                2、or语句前后没有同时使用索引。当or左右查询字段只有一个是索引，该索引失效，只有当or左右查询字段均为索引时，才会生效
                3、组合索引，不是使用第一列索引，索引失效。
                4、数据类型出现隐式转化。如varchar不加单引号的话可能会自动转换为int型，使索引无效，产生全表扫描。
                5、在索引字段上使用not，<>，!=。不等于操作符是永远不会用到索引的，因此对它的处理只会产生全表扫描。 优化方法： key<>0 改为 key>0 or key<0。
                6、对索引字段进行计算操作、字段上使用函数。
                7、当全表扫描速度比索引速度快时，mysql会使用全表扫描，此时索引失效。
         * */
    }


    //一些题目
    public function timu(){
        /*
        +---------------+---------+
        | Column Name   | Type    |
        +---------------+---------+
        | id            | int     |
        | revenue       | int     |
        | month         | varchar |
        +---------------+---------+
        (id, month) 是表的联合主键。
        这个表格有关于每个部门每月收入的信息。
        月份（month）可以取下列值 ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]。

        编写一个 SQL 查询来重新格式化表，使得新的表中有一个部门 id 列和一些对应 每个月 的收入（revenue）列。

        查询结果格式如下面的示例所示：

        Department 表：
        +------+---------+-------+
        | id   | revenue | month |
        +------+---------+-------+
        | 1    | 8000    | Jan   |
        | 2    | 9000    | Jan   |
        | 3    | 10000   | Feb   |
        | 1    | 7000    | Feb   |
        | 1    | 6000    | Mar   |
        +------+---------+-------+

        查询得到的结果表：
        +------+-------------+-------------+-------------+-----+-------------+
        | id   | Jan_Revenue | Feb_Revenue | Mar_Revenue | ... | Dec_Revenue |
        +------+-------------+-------------+-------------+-----+-------------+
        | 1    | 8000        | 7000        | 6000        | ... | null        |
        | 2    | 9000        | null        | null        | ... | null        |
        | 3    | null        | 10000       | null        | ... | null        |
        +------+-------------+-------------+-------------+-----+-------------+

        注意，结果表有 13 列 (1个部门 id 列 + 12个月份的收入列)。

        SELECT id,
        SUM(CASE `month` WHEN 'Jan' THEN revenue END) Jan_Revenue,
        SUM(CASE `month` WHEN 'Feb' THEN revenue END) Feb_Revenue,
        SUM(CASE `month` WHEN 'Mar' THEN revenue END) Mar_Revenue,
        SUM(CASE `month` WHEN 'Apr' THEN revenue END) Apr_Revenue,
        SUM(CASE `month` WHEN 'May' THEN revenue END) May_Revenue,
        SUM(CASE `month` WHEN 'Jun' THEN revenue END) Jun_Revenue,
        SUM(CASE `month` WHEN 'Jul' THEN revenue END) Jul_Revenue,
        SUM(CASE `month` WHEN 'Aug' THEN revenue END) Aug_Revenue,
        SUM(CASE `month` WHEN 'Sep' THEN revenue END) Sep_Revenue,
        SUM(CASE `month` WHEN 'Oct' THEN revenue END) Oct_Revenue,
        SUM(CASE `month` WHEN 'Nov' THEN revenue END) Nov_Revenue,
        SUM(CASE `month` WHEN 'Dec' THEN revenue END) Dec_Revenue
        FROM Department
        GROUP BY id;
        注意 : 这里的SUM起到遍历的作用而不是求和
        */

        /*

        您想知道用户访问您的应用程序的时间。您决定创建“[0-5>”，“[5-10>”，“[10-15>” 和 “15 minutes and more”四个时段，并计算每个时段的用户数。
        select(
        case
        when duration >= 0
        and duration < 5 * 60 then "[0-5>"
        when duration >= 5 * 60
        and duration < 10 * 60 then "[5-10>"
        when duration >= 10 * 60
        and duration < 15 * 60 then "[10-15>"
        else "15 or more"
        end
        ) bin,
        count(*) total
        from Sessions
        group by ( //group by中还可以这样写!
        case
        when duration >= 0
        and duration < 5 * 60 then "[0-5>"
        when duration >= 5 * 60
        and duration < 10 * 60 then "[5-10>"
        when duration >= 10 * 60
        and duration < 15 * 60 then "[10-15>"
        else "15 or more"
        end
        );
         */



        //18,19,20题是成绩排名问题 要重点看
        //29,45,46题是查询日期  总结:timestampdiff(interval,datetime_expr1,datetime_expr2)回日期或日期时间表达式datetime_expr1 和datetime_expr2the 之间的整数差,查询年龄时候比较好 DATEDIFF() 函数返回两个日期之间的天数。
        //总结 : week和weekofyear函数,可以选择以周一作为每周的开始,或者以周日作为每周的开始
        //33题 总结 : 如果用left join联查,则on是联查条件,所以会把左表都查出来 , 如果使用where查询两个表这种查询where是查询条件,则会把两个表的交集查出来,其余的不查询,所以两种查询还是有区别的

        //23.查询各科成绩前三名的记录
        //$data = DB::select('select s1.id,s1.subject_id,s1.student_id,s1.score from three_score s1 where (select count(distinct s2.score) from three_score s2 where s1.score<s2.score and s1.subject_id=s2.subject_id)<3 order by s1.subject_id,s1.score desc');//(最优解) 解释:查询的过程是从头到尾查询了s1表,把每个s1表的成绩和s2表的成绩做比较,在学科相同的情况下,查询s2的成绩比s1此刻这一条成绩大的数量,如果这个数量<3,那么说明比此刻的s1成绩大的s2中的所有成绩不超过3条,就说明这条成绩是s1的前三名(注意,查询s2时候,distinct这个去重复值是个关键点,如果加上distinct,那么查询出来的是前三名的三种成绩,不管重复多少次,都会把这三种成绩的情况都查处理啊,如果不加distinct那么查询出来的成绩是三个成绩,但是如果有重复的,则会大于三条)
        //$data = DB::select('select s1.subject_id,s1.student_id,s1.score from three_score s1 left join three_score s2 on s1.subject_id=s2.subject_id and s2.score>s1.score group by s1.student_id,s1.subject_id,s1.score having count(s2.subject_id)<3 order by s1.subject_id,s1.score desc');//相对优解


        //新问题 : players表的根据age排序问题
        //$data = DB::select('select two_players.*,case when @ages=age then @num when @ages:=age then @num:=@num+1 end ranks from two_players,(select @ages:=null,@num:=0) r order by age desc');//(不考虑重复的排序,例如1-2-2-3-4这样排序)
        //$data = DB::select('select two_players.*,case when @ages=age then @num when @ages:=age then @num:=@r2 end ranks,@r2:=@r2+1 from two_players,(select @ages:=null,@num:=0,@r2:=1) r order by age desc');//(考虑重复的排序,例如1-2-2-4-5这样排序)
        //$data = DB::select('select players.*,@num:=if(@ages=age,@num,@num+1) ranks,@ages:=age from players,(select @ages:=null,@num:=0) r order by age desc');//(不考虑重复的排序,例如1-2-2-3-4这样排序)
        //$data = DB::select('select players.*,@num:=if(@ages=age,@num,@num2) ranks,@ages:=age,@num2:=@num2+1 from players,(select @ages:=null,@num:=0,@num2:=1) r order by age desc');//(考虑重复的排序,例如1-2-2-4-5这样排序)

        //18.按各科平均成绩进⾏排序，并显示排名， Score 重复时保留名次空缺(答案报错)
        //$data = DB::select('select sc.*,case when @cj=sc.pjcj then @num when @cj:=sc.pjcj then @num:=@num+1 end ranks from (select CId,round(avg(score),2) pjcj from SC group by CId order by pjcj desc) sc,(select @cj:=null,@num:=0) r');//我的答案
        //$data = DB::select('select sc.*,@num:=if(@cj=sc.pjcj,@num,@num+1) ranks,@cj:=pjcj from (select CId,round(avg(score),2) pjcj from SC group by CId order by pjcj desc) sc,(select @cj:=null,@num:=0) r');//我的答案

        //$data = DB::select('select s2.cid,s2.avg_sc,count(s1.avg_sc) as ranks

        //from
        //(SELECT cid,ROUND(AVG(score),2) as avg_sc from sc GROUP BY cid ) as s1
        //join
        //(SELECT cid,ROUND(AVG(score),2) as avg_sc from sc GROUP BY cid ) as s2
        //on s1.avg_sc>=s2.avg_sc and s1.cid = s1.cid
        //group by s2.cid, s2.avg_sc
        //order by ranks'); //答案

        //19.按各科平均成绩进⾏排序，并显示排名， Score 重复时不保留名次空缺(答案报错)
        //$data = DB::select('select sc.*,@num:=if(@cj=sc.pjcj,@num,@num2) ranks,@cj:=pjcj,@num2:=@num2+1 from (select CId,round(avg(score),2) pjcj from SC group by CId order by pjcj desc) sc,(select @cj:=null,@num:=0,@num2:=1) r');
        //$data = DB::select('SELECT b.cid,b.avg_sc,@i:=@i+1 as rankfrom (SELECT @i :=0) as a,(SELECT cid,round(avg(score),2) as avg_sc from sc GROUP BY cid ORDER BY avg_sc desc) as b');//答案

        //20.查询学生的总成绩，并进⾏排名，总分重复时保留名次空缺
        //$data = DB::select('SELECT A.*,@rownum:=if(@total=A.total,@rownum,@rank) as ranks,@total:=A.total,@rank:=@rank+1 FROM (select SId,sum(score) total from SC group by SId order by total desc) A,(select @rownum:=0,@rank:=1,@total:=null) B');//我的答案


        //$data = DB::select('SELECT s2.sid,s2.sum_sc,COUNT(s2.sum_sc) as ranks from
        //(SELECT sid,sum(score) as sum_sc from sc GROUP BY sid ORDER BY sid) as s1
        //JOIN
        //(SELECT sid,sum(score) as sum_sc from sc GROUP BY sid ORDER BY sid) as s2
        //on s1.sum_sc>=s2.sum_sc
        //group by s2.sid,s2.sum_sc
        //order by ranks;');//答案

        //21.查询学生的总成绩，并进⾏排名，总分重复时不保留名次空缺(总成绩排名问题明天去学习https://blog.csdn.net/a56508820/article/details/49663069和https://www.jianshu.com/p/bb1b72a1623e)
        //$data = DB::select('select A.*,case when @total=A.total then @num when @total:=total then @num:=@num+1 end ranks from (select SId,sum(score) total from SC group by SId order by total desc) A,(select @total:=null,@num:=0) B');//我的答案
        //$data = DB::select('select A.*,@num:=if(@total=total,@num,@num+1) ranks,@total:=total from (select SId,sum(score) total from SC group by SId order by total desc) A,(select @total:=null,@num:=0) B');//我的答案
        //$data = DB::select('SELECT b.sid,b.sum_sc,@i:=@i+1 as ranks from (SELECT @i :=0) as a,(SELECT sid,sum(score) as sum_sc from sc GROUP BY sid ORDER BY sum_sc desc) as b');//答案



        //1.查询" 01 "课程⽐" 02 "课程成绩⾼的学⽣的信息及课程分数
        //$data = DB::select('select Student.*,SC.CId,SC.score from Student left join SC on Student.SId=SC.SId where Student.SId in (select a.SId from SC a,SC b where a.score>b.score and a.CId=01 and b.CId=02 and a.SId=b.SId)');//我的答案
        //$data = DB::select('select Student.*,SC.CId,SC.score from Student left join SC on Student.SId=SC.SId where Student.SId in(select a.SId from SC a left join SC b on a.SId=b.SId where a.score>b.score and a.CId=01 and b.CId=02)');//我的答案
        //$data = DB::select('SELECT stu.*,s.score FROM student AS stu JOIN (SELECT s1.sid,s1.score FROM ( SELECT sid, score FROM sc WHERE Cid = 01 ) AS s1 JOIN ( SELECT sid, score FROM sc WHERE Cid = 02 ) AS s2 ON s1.sid = s2.sid  WHERE s1.score > s2.score ) AS s ON stu.sid = s.sid;');//答案

        //2.查询同时存在" 01 "课程和" 02 "课程的情况
        //$data = DB::select('select a.SId,a.score score1,b.score score2 from SC a,SC b where a.CId=01 and b.CId=02 and a.SId=b.SId and a.score>0 and b.score>0');//我的答案
        //$data = DB::select('select a.SId,a.score score1,b.score score2 from SC a left join SC b on a.SId=b.SId where a.CId=01 and b.CId=02');//我的答案
        //$data = DB::select('SELECT s1.sid,s1.score as 01_score,s2.score as 02_score FROM (SELECT sid,score from sc WHERE cid=01) as s1 JOIN (SELECT sid,score from sc WHERE cid=02) as s2 on s1.sid = s2.sid');//答案

        //3.查询存在" 01 "课程但可能不存在" 02 "课程的情况(不存在时显示为 null )
        //$data = DB::select('select * from SC where SId in (select SId from SC where CId=01 and SId not in (select SId from SC where CId=02 group by SId))');//我的答案
        //$data = DB::select('SELECT s1.sid,s1.score as 01_score,s2.score as 02_score FROM (SELECT sid,score from sc WHERE cid=01) as s1 LEFT JOIN (SELECT sid,score from sc WHERE cid=02) as s2 on s1.sid = s2.sid');//答案

        //4.查询不存在" 01 "课程但存在" 02 "课程的情况
        //$data = DB::select('select * from SC where SId in (select SId from SC where CId=02 and SId not in (select SId from SC where CId=01 group by SId))');//我的答案
        //$data = DB::select('SELECT s2.sid,s1.score as 01_score,s2.score as 02_score FROM (SELECT sid,score from sc WHERE cid=01) as s1 RIGHT JOIN (SELECT sid,score from sc WHERE cid=02) as s2 on s1.sid = s2.sid;');//答案

        //5.查询平均成绩⼤于等于 60 分的同学的学⽣编号和学⽣姓名和平均成绩
        //$data = DB::select('select a.*,b.avgscore from Student a join (select SId,avg(score) avgscore from SC GROUP BY SId having avgscore>=60) b on a.SId=b.SId');
        //$data = DB::select('SELECT a.*,b.avgscore from student a JOIN (SELECT sid,avg(score) avgscore from sc GROUP BY sid) b on a.sid = b.sid WHERE b.avgscore >60;');

        //6.查询在 SC 表存在成绩的学⽣信息
        //$data = DB::select('select * from Student where SId in (select SId from SC group by SId)');//我的答案
        //$data = DB::select('select * from Student a join (select SId from SC group by SId) b on a.SId=b.SId');//我的答案
        //$data = DB::select('SELECT distinct stu.* from student as stu,sc WHERE stu.SId=sc.SId');//答案

        //7.查询所有同学的学⽣编号、学⽣姓名、选课总数、所有课程的总成绩(没成绩的显示为 null )
        //$data = DB::select('select stu.SId,stu.Sname,sc.sumscore,sc.num from Student stu left join (select SId,count(SId) num,sum(score) sumscore from SC group by SId) sc on stu.SId=sc.SId');//我的答案不好
        //$data = DB::select("SELECT stu.SId,stu.Sname,count(sc.SId) as '选课总数',sum(sc.score) as '所有课程的总成绩' from student as stu LEFT join sc on stu.SId = sc.SId GROUP BY stu.SId,stu.sname;");//答案

        //8.查询「李」姓老师的数量
        //$data = DB::select('select count(*) \'李姓老师的数量\' from Teacher where Tname like \'李%\'');//我的答案
        //$data = DB::select("SELECT count(*) FROM teacher WHERE tname like '李%'");//答案

        //9.查询学过「张三」老师授课的同学的信息
        //$data = DB::select('select stu.* from Student stu left join SC sc on stu.SId=sc.SId left join Course cou on sc.CId=cou.CId left join Teacher tea on cou.TId=tea.TId where tea.Tname=\'张三\'');//我的答案
        //$data = DB::select('SELECT s1.* FROM (SELECT stu.*,sc.CId from student as stu join sc on stu.SId = sc.SId) as s1 JOIN (SELECT teacher.Tname,course.cid FROM course join teacher on course.tid = teacher.Tid) as c1 on s1.cid = c1.cid WHERE c1.tname = \'张三\'');//答案

        //10.查询没有学全所有课程的同学的信息
        //$data = DB::select('select stu.*,count(sc.SId) num from Student stu left join SC sc on stu.SId=sc.SId group by stu.SId having num<(select count(*) from Course)');//我的答案
        //$data = DB::select('SELECT stu.* FROM student as stu where sid not in (SELECT s1.sid FROM (SELECT sid,count(sid) as count_sid FROM sc GROUP BY sid) as s1 WHERE s1.count_sid=3)');//答案

        //11.查询至少有一门课与学号为" 01 "的同学所学相同的同学的信息
        //$data = DB::select('select * from Student where SId in (select SId from SC where CId in (select CId from SC where SId=01))');//我的答案
        //$data = DB::select('select distinct * from Student join (select SId from SC where CId in (select CId from SC where SId=01)) s1 on Student.SId=s1.SId');//我的答案
        //$data = DB::select('SELECT DISTINCT stu.* from student as stu JOIN sc on stu.sid = sc.SId WHERE sc.CId in (SELECT cid FROM sc where sid=01)');//答案

        //12.查询和" 01 "号的同学学习的课程 完全相同的其他同学的信息(没做出来)
        //$data = DB::select('SELECT stu.* FROM student as stu JOIN (SELECT s2.sid FROM sc as s1 JOIN sc as s2 on s1.cid = s2.cid and s1.sid=01 and s2.sid!=01 GROUP BY s2.sid HAVING count(s2.cid)=(SELECT count(*) from sc where sid=01)) as s on stu.SId = s.sid');//答案(答案完全不对!)


        //13.查询没学过"张三"老师讲授的任⼀门课程的学生姓名
        //$data = DB::select('select * from Student where SId not in (select SId from SC where CId in (select CId from Course where TId in (select TId from Teacher where Tname=\'张三\')))');//我的答案
        //$data = DB::select('SELECT * from student WHERE SId not in (SELECT s1.sid FROM (SELECT stu.*,sc.CId from student as stu join sc on stu.SId = sc.SId) as s1 JOIN (SELECT teacher.Tname,course.cid FROM course join teacher on course.tid = teacher.Tid) as c1 on s1.cid = c1.cid WHERE c1.tname = \'张三\')');//答案


        //14.查询两门及其以上不及格课程的同学的学号，姓名及其平均成绩
        //$data = DB::select('select stu.Sname,sc.SId,count(sc.SId) num,avg(sc.score) \'平均成绩\' from Student stu,SC sc where sc.score<60 and stu.SId=sc.SId group by sc.SId having num>=2');
        //$data = DB::select('select stu.Sname,sc.SId,count(sc.SId) num,avg(sc.score) \'平均成绩\' from Student stu left join SC sc on stu.SId=sc.SId where sc.score<60 group by sc.SId having num>=2');
        //$data = DB::select('SELECT stu.sname,stu.sid,s1.avg_score from student as stu JOIN (SELECT sid,AVG(score) as avg_score from sc where score<60 GROUP BY sid HAVING count(*)>=2) as s1 on stu.sid = s1.sid');//答案

        //15.检索" 01 "课程分数⼩于 60，按分数降序排列的学生信息
        //$data = DB::select('select stu.*,sc.score from student stu,SC sc where stu.SId=sc.SId and sc.CId=01 and sc.score<60 order by sc.score desc');//我的答案
        //$data = DB::select('select stu.*,sc.score from student stu join SC sc on stu.SId=sc.SId where sc.CId=01 and sc.score<60 order by sc.score desc');//我的答案
        //$data = DB::select('SELECT * FROM student WHERE sid in (SELECT sid from sc WHERE cid=01 and score<60 ORDER BY score DESC)');//答案


        //16.按平均成绩从⾼到低显示所有学生的所有课程的成绩以及平均成绩
        //$data = DB::select('select sc.score,sc.CId,s1.SId,s1.avgscore,stu.Sname from SC sc left join (select SId,avg(score) as avgscore from SC group by SId) s1 on sc.SId=s1.SId left join  Student stu on sc.SId=stu.SId order by s1.avgscore desc') ;//我的答案
        //$data = DB::select('SELECT sc.*,s2.avg_score FROM sc  join (SELECT sid,AVG(score) as avg_score from sc GROUP BY sid) as s2 on sc.sid = s2.sid ORDER BY s2.avg_score DESC');//答案

        //17.查询各科成绩最高分、最低分和平均分： 以如下形式显示：课程 ID，课程 name，最高分，最低分，平均分，及格率，中等率，优良率，优秀率 及格为>=60，中等为：70-80，优良为：80-90，优秀为：>=90 要求输出课程号和选修⼈数，查询结果按⼈数降序排列，若⼈数相同，按课程号升序排列
        //       $data = DB::select('select sc.CId,cou.Cname,max(sc.score),min(sc.score),avg(sc.score),count(sc.CId) renshu,
        //sum(case when sc.score>=60 then 1 else 0 end)/count(sc.CId) \'及格率\',
        //sum(case when sc.score>=70 and sc.score<80 then 1 else 0 end)/count(sc.CId) \'中等率\',
        //sum(case when sc.score>=80 and sc.score<90 then 1 else 0 end)/count(sc.CId) \'优良率\',
        //sum(case when sc.score>=90 then 1 else 0 end)/count(sc.CId) \'优秀率\'
        // from SC sc left join course cou on sc.CId=cou.CId group by sc.CId order by renshu desc,sc.CId asc');//我的答案
        //        $data = DB::select('SELECT sc.cid,course.Cname,max(sc.score) as \'最高分\',min(sc.score) as \'最低分\',
        //AVG(sc.score) as \'平均分\',count(sc.CId) as \'选修人数\',
        //SUM(case when sc.score>=60 then 1 else 0 end)/count(sc.CId) as \'及格率\',
        //SUM(case when sc.score>=70 and sc.score<80 then 1 else 0 end)/count(sc.CId) as \'中等率\',
        //SUM(case when sc.score>=80 and sc.score<90 then 1 else 0 end)/count(sc.CId) as \'优良率\',
        //SUM(case when sc.score>=90 then 1 else 0 end)/count(sc.CId) as \'优秀率\'
        //from sc,course WHERE sc.CId=course.CId
        //GROUP BY sc.cid,course.Cname
        //ORDER BY \'选修人数\' DESC,sc.cid;');//答案


        //22.统计各科成绩各分数段人数：课程编号，课程名称，[100-85]，[85-70]，[70-60]，[60-0]及所占百分比
        //        $data = DB::select('select sc.CId,cou.Cname,count(sc.CId) num,
        //sum(case when sc.score>85 and sc.score<=100 then 1 else 0 end)/count(sc.CId) \'[100-85]百分比\',
        //sum(case when sc.score>85 and sc.score<=100 then 1 else 0 end) \'[100-85]人数\',
        //sum(case when sc.score>70 and sc.score<=85 then 1 else 0 end)/count(sc.CId) \'[85-70]百分比\',
        //sum(case when sc.score>70 and sc.score<=85 then 1 else 0 end) \'[85-70]人数\',
        //sum(case when sc.score>60 and sc.score<=70 then 1 else 0 end)/count(sc.CId) \'[70-60]百分比\',
        //sum(case when sc.score>60 and sc.score<=70 then 1 else 0 end) \'[70-60]人数\',
        //sum(case when sc.score<=60 then 1 else 0 end)/count(sc.CId) \'[60-0]百分比\',
        //sum(case when sc.score<=60 then 1 else 0 end) \'[60-0]人数\'
        //from SC sc,Course cou where sc.CId=cou.CId group by sc.CId');//我的答案

        //        $data = DB::select('SELECT sc.CId,c.cname,
        //SUM(case when sc.score>85 and sc.score<=100 then 1 else 0 end) as \'[100-85]\',
        //SUM(case when sc.score>85 and sc.score<=100 then 1 else 0 end)/count(sc.CId) as \'百分比1\',
        //SUM(case when sc.score>70 and sc.score<=85 then 1 else 0 end) as \'[85-70]\',
        //SUM(case when sc.score>70 and sc.score<=85 then 1 else 0 end)/count(sc.CId) as \'百分比2\',
        //SUM(case when sc.score>60 and sc.score<=70 then 1 else 0 end) as \'[70-60]\',
        //SUM(case when sc.score>60 and sc.score<=70 then 1 else 0 end)/count(sc.CId) as \'百分比3\',
        //SUM(case when sc.score>0 and sc.score<=60 then 1 else 0 end) as \'[60-0]\',
        //SUM(case when sc.score>0 and sc.score<=60 then 1 else 0 end)/count(sc.CId) as \'百分比4\'
        //FROM sc join course as c on sc.CId=c.cid
        //GROUP BY sc.CId,c.cname');//答案


        //24.查询每门课程被选修的学生数
        //$data = DB::select('select CId,count(CId) as \'选课人数\' from SC group by CId');//我的答案

        //25.查询出只选修两门课程的学生学号和姓名
        //$data = DB::select('select stu.Sname,stu.SId,count(sc.SId) from Student stu,SC sc where stu.SId=sc.SId group by sc.SId having count(sc.SId)=2');//我的答案
        //$data = DB::select('select Sname,SId from Student where SId in (select SId from SC group by SId having count(SId)=2)');//我的答案
        //$data = DB::select('SELECT s2.sid,s2.sname FROM (SELECT sid,count(sid) as \'选修课程数\'  FROM sc GROUP BY SId) as s1 JOIN student as s2 on s1.SId = s2.SId WHERE s1.选修课程数=2');//答案

        //26.查询男生、⼥生⼈数
        //$data = DB::select('select Ssex,count(Ssex) \'人数\' from Student group by Ssex');//我的答案

        //27.查询名字中含有「风」字的学生信息
        //$data = DB::select("select * from Student where Sname like '%风%'");//我的答案

        //28.查询同名同姓学生名单，并统计同名⼈数
        //$data = DB::select('select Sname,count(Sname) \'人数\' from Student group by Sname having count(Sname)>=2');//我的答案

        //29.查询 1990 年出生的学生名单
        //$data = DB::select("select * from Student where Sage like '%1990%'");//我的答案
        //$data = DB::select('SELECT * FROM student WHERE YEAR(sage)=1990');//答案
        //$data = DB::select('SELECT * FROM student WHERE MONTH(sage)=06');
        //$data = DB::select('SELECT * FROM student WHERE DAY(sage)=21');

        //30.查询每门课程的平均成绩，结果按平均成绩降序排列，平均成绩相同时，按课程编号升序排列
        //$data = DB::select('select CId,avg(score) from SC group by CId order by avg(score) desc,CId asc');//我的答案

        //31.查询平均成绩⼤于等于 85 的所有学生的学号、姓名和平均成绩
        //$data = DB::select('select stu.Sname,sc.SId,avg(sc.score) avgscore from Student stu,SC sc where sc.SId=stu.SId group by sc.SId having avgscore>=85');
        //$data = DB::select('select stu.Sname,sc.SId,avg(sc.score) avgscore from Student stu left join SC sc on sc.SId=stu.SId group by stu.SId having avgscore>=85');
        //$data = DB::select('SELECT s1.sid,s1.sname,s2.平均分 FROM student as s1 join (SELECT sid,AVG(score) as \'平均分\' FROM sc GROUP BY sid) as s2 on s1.SId = s2.SId WHERE s2.平均分>=85');

        //32.查询课程名称为「数学」，且分数低于 60 的学生姓名和分数
        //$data = DB::select('select stu.Sname,sc.score from Student stu left join SC sc on stu.SId=sc.SId left join Course cou on sc.CId=cou.CId where cou.Cname=\'数学\' and sc.score<60');//我的答案
        //$data = DB::select('SELECT s2.sname,s1.score FROM course as c1 JOIN sc as s1 on c1.cid=s1.CId JOIN student as s2 on s1.sid =s2.SId WHERE c1.cname=\'数学\' and s1.score<60');//答案

        //33.查询所有学生的课程及分数情况（存在学生没成绩，没选课的情况）
        //$data = DB::select('select stu.*,cou.Cname,sc.score from Student stu left join SC sc on stu.SId=sc.SId left join Course cou on sc.CId=cou.CId');//如果用left join联查,则on是联查条件,所以会把左表都查出来//我的答案
        //$data = DB::select('select stu.*,sc.CId,sc.score from Student stu , SC sc where stu.SId=sc.SId');//如果使用这种查询,where是查询条件,则会把两个表的交集查出来,其余的不查询,所以两种查询还是有区别的//我的答案
        //$data = DB::select('SELECT s2.sname,s2.sid,c1.cname,s1.score FROM sc as s1 right JOIN student as s2 on s1.sid =s2.SId left JOIN course as c1 on s1.cid=c1.cid GROUP BY s2.sid,s2.sname,c1.cname,s1.score');//答案

        //34.查询任何⼀门课程成绩在 70 分以上的姓名、课程名称和分数
        //$data = DB::select('select stu.Sname,cou.Cname,sc.score from Student stu,SC sc,Course cou where stu.SId=sc.SId and sc.CId=cou.CId and sc.score>70');//我的答案
        //$data = DB::select('select stu.Sname,cou.Cname,sc.score from Student stu join SC sc on stu.SId=sc.SId join Course cou on sc.CId=cou.CId where sc.score>70');//我的答案
        //$data = DB::select('SELECT s2.sname,c1.cname,s1.score FROM sc as s1 JOIN student as s2 on s1.sid =s2.SId JOIN course as c1 on s1.cid=c1.cid WHERE s1.score>70');//答案

        //35.查询不及格的课程
        //$data = DB::select('select stu.Sname,cou.Cname,sc.score from Student stu join SC sc on stu.SId=sc.SId join Course cou on sc.CId=cou.CId where sc.score<60');//我的答案
        //$data = DB::select('SELECT s2.sname,c1.cname,s1.score FROM sc as s1 JOIN student as s2 on s1.sid =s2.SId JOIN course as c1 on s1.cid=c1.cid WHERE s1.score<60');//答案

        //36.查询课程编号为 01 且课程成绩在 80 分以上的学生的学号和姓名
        //$data = DB::select('select stu.Sname,stu.SId,sc.CId,cou.Cname from Student stu join SC sc on stu.SId=sc.SId join Course cou on sc.CId=cou.CId where sc.CId=01 and sc.score>=80');//我的答案
        //$data = DB::select('SELECT s1.sid,s2.Sname FROM (SELECT sid,score FROM sc WHERE cid=\'01\') as s1 JOIN student as s2 on s1.sid =s2.SId WHERE score>=80');//答案
        //$data = DB::select('select SC.SId,Student.Sname from SC join Student on SC.SId = Student.SId where SC.Score > 80 and SC.CId = \'01\';');//答案

        //37.求每门课程的学生⼈数
        //$data = DB::select('select CId,count(CId) from sc group by CId');//我的答案

        //38.成绩不重复，查询选修「张三」老师所授课程的学生中，成绩最⾼的学生信息及其成绩
        //$data = DB::select('select stu.Sname,s1.* from Student stu join (select SId,score,CId from SC WHERE score in (select max(score) from SC where CId=02) and CId=02) s1 on stu.SId=s1.SId');
        //$data = DB::select('SELECT s2.sname,s2.SId,s1.score FROM course as c1 JOIN sc as s1 on c1.cid=s1.CId JOIN student as s2 on s1.sid =s2.SId JOIN teacher as t1 on c1.tid=t1.tid WHERE t1.tname=\'张三\' ORDER BY s1.score DESC  LIMIT 1');//答案(很奇怪的答案)

        //39.成绩有重复的情况下，查询选修「张三」老师所授课程的学生中，成绩最⾼的学生信息及其成绩
        //$data = DB::select('SELECT s2.sname,s2.sid,s1.score FROM student as s2 JOIN sc as s1 on s1.SId =s2.SId WHERE score=(SELECT max(score) FROM sc as s1 WHERE cid=(SELECT c1.cid FROM course as c1 JOIN teacher as t1 on c1.tid = t1.tid WHERE t1.tname = \'张三\'))');//答案

        //40.查询不同课程成绩相同的学生的学生编号、课程编号、学生成绩(这题出的脑瘫)
        //$data = DB::select('select distinct a.SId,a.CId,a.score from SC a,SC b where a.SId!=b.SId and a.CId!=b.CId and a.score=b.score');//我的答案
        //$data = DB::select('SELECT sid,cid,score FROM sc WHERE sid=(select sid from (select sid,score from sc group by sid,score) as s1 group by sid having count(sid)=1)');//答案

        //41.查询每门课程成绩最好的前两名

        //42.统计每门课程的学生选修⼈数（超过 5 ⼈的课程才统计）。
        //$data = DB::select('select Cid,count(Cid) renshu from SC GROUP BY CId having renshu>5');//我的答案
        //$data = DB::select('SELECT cid,count(cid) as \'学生人数\' FROM sc GROUP BY cid HAVING count(cid)>5');//答案

        //43.检索⾄少选修两门课程的学生学号
        //$data = DB::select('select SId,count(CId) kecheng from SC GROUP BY SId having kecheng>=2');//我的答案

        //44.查询选修了全部课程的学生信息
        //$data = DB::select('select stu.* from SC sc,Student stu where sc.SId=stu.SId group by sc.SId having count(sc.CId)=(select count(*) from Course)');//我的答案
        //$data = DB::select('SELECT sid FROM sc GROUP BY SId HAVING count(sid)=3');//答案

        //45.查询各学生的年龄，只按年份来算
        //$data = DB::select('select SId,now(),year(now())-year(Sage) from Student');//答案

        //46.按照出生日期来算，当前月日 < 出生年月的月日则，年龄减⼀
        //$data = DB::select('select student.sid, student.sname,student.ssex, sage,timestampdiff(year,sage,now()) as \'按月日计算\',  year(now())-year(sage) as \'按年份计算\' from student;');//答案

        //47.查询本周过生日的学生
        //$data = DB::select('select * from Student where week(\'2020-12-19\')=week(Sage)');//我的答案
        //$data = DB::select('select sid, sname,ssex, sage from student WHERE WEEKOFYEAR(student.Sage)=WEEKOFYEAR(CURDATE())');//答案


        return ['errCode' => '0000', 'errMsg' => '成功', 'data' => $data];
    }
}