<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller {
    /**
     * 测试
     *
     * @param  int $id
     *
     */
    public function mysqlCS() {
        //mysql主从,索引,锁



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

        //总结6.成绩排序问题非常非常重要  使用rank()over()遇到成绩相同时候是像这样排序1-2-2-4  而dense_rank()over()函数成绩相同时候是这样排序1-2-2-3  而row_num()over()即使有成绩相同那也是1-2-3-4这么排序
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