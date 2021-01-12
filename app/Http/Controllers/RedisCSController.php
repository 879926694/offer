<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Cache;

class RedisCSController extends Controller {
    /**
     */
    public function redisZongJie() {
        /*
         laravel使用redis,需要先composer require predis/predis,然后确认php的redis扩展是否安装,然后就可以直接$values = Redis::lrange('names', 5, 10);使用了
        写法可以 : $values = Redis::lrange('names', 5, 10);   也可以$values = Redis::command('lrange', ['name', 5, 10]);
        连接其他的redis库 $redis = Redis::connection('my-connection');
         * */
        echo '123';
    }

    //keys相关命令 :
    public function keysCeshi() {
        //$a = Redis::randomkey(); //随机获取一个key,成功则返回字符串
        //$a = Redis::del('tiancai');//删除key,成功则返回int(1)  失败返回int(0)
        //$a = Redis::type('hash1');//key对应的类型,返回的是int1-5,对应的是  string->int(1) list->int(3)   set->int(2)   sortedSet->int(4)   hash->int(5)
        //$a = Redis::expire('ceshi',600);//设置过期时间,成功返回bool(true),失败返回bool(false)
        //$a = Redis::rename('name','newname');//重命名,成功返回bool(true),失败返回bool(false)
        //$a = Redis::ttl('ceshi');//返回设置过期时间的key的剩余秒数,未设置过期时间返回int(-1),设置过期时间返回int(秒数)
        //$a = Redis::select(1);//切换数据库,成功返回bool(true),失败返回bool(false)
        //$a = Redis::move('ceshi',0);//将key从当前数据库移动到指定数据库,成功则返回bool(true)
        //$a = Redis::keys('*');//获取所有key,成功返回array();
        //var_dump($a);
    }

    //String类型相关命令 :
    public function stringCeshi() {
        //存取(存单条(覆盖式),存单条(不覆盖),存多条)
        //$a = Redis::set('sex','女'); //设置key对应的String类型,成功返回bool(true)
        //$a = Redis::setnx('sex','男'); //如果key不存在,设置key对应的String类型.如果key已经存在,返回int(0),并且值不会改变,如果key不存在则创建,返回int(1)
        //$a = Redis::get('sex1'); //获取key对应的String值,如果key不存在返回null,存在返回对应字符串
        //$a = Redis::getset('sex2','2b'); //先获取key的值,再设置key的值.如果key不存在返回bool(false),key存在则返回设置之前的value
        //$a = Redis::mget(['sex','sex1','sex2','2b']); //一次获取多个key值,返回array(),但是返回的是索引数组不是关联数组,如果对应的key不存在,则数组中对应的值为null,注意,这里传的参数是['key1','key2']
        //$a = Redis::mset(['name1'=>'name','name4'=>'name4','name5'=>'name5']);//一次设置多个key的值,成功返回bool(true),表示所有值都设置;失败返回bool(false),表示没有任何值被设置


        //增减(增加1,增加指定值)
        //$a = Redis::incr('name');//向key对应的值加1,并返回新的值,注意value必须是数字,否则返回bool(false),incr一个不存在的key,则设置为1返回int(1),成功返回int(加1以后的数字)
        //$a = Redis::decr('name');//和上面的相反
        //$a = Redis::incrby('name1',2);//向key对应的值加上一个指定的整数integer,value必须是整数,integer必须是整数,否则返回bool(false),incr一个不存在的key,则设置为1返回int(1),成功返回int(加1以后的数字)
        //$a = Redis::decrby('name',1);//和上面的相反
        //var_dump($a);
    }

    //List类型相关命令 : list类型相当于一个罐子里有很多颜色的球,颜色可以相同
    public function listCeshi() {
        //出入(头部出,尾部出,头部删,尾部删,扫描所有删头部,扫描所有删尾部)
        //$a = Redis::lpush('list1','0'); //向key对应List头部添加一个字符串元素,成功返回int(全部数量)
        //$a = Redis::rpush('list1','2'); //向key对应List尾部添加一个字符串元素
        //$a = Redis::lpop('list2');//从list头部删除并返回删除元素.如果key对应List不存在或者是空返回false,返回被删除的字符串,删除最后一个元素后,则该list就不存在了
        //$a = Redis::rpop('list2');//从list尾部删除并返回删除元素.如果key对应List不存在或者是空返回false,返回被删除的字符串,删除最后一个元素后,则该list就不存在了
        //$a = Redis::blpop(['list2','list3'],10);//从左到右扫描key1...keyN,返回对第一个非空List进行lpop操作并返回.,正常返回[0=>"list1",1=> "check_4"] 第一个是进行lpop的key,第二个是删除并返回的元素,如果所有List都是空或不存在,阻塞timeout秒,timeout为0表示一直阻塞.阻塞时,如果有其他client队key1...keyN中任意一个key进行push操作,阻塞解除并返回.如果超时发生,则返回nil
        //$a = Redis::brpop(['list2','list3'],10);//与blpop相似,不同的是blpop从头部删除,而brpop从尾部删除


        //长度,取值,截取,删除几个值,设置下标
        //$a = Redis::llen('list2');//返回key对应List的长度,key必须是List类型否则返回false,如果key不存在,那返回int(0)
        //$a = Redis::lrange('list1',0,-1);//返回指定区间内(start ~ end)的元素,下标从0开始,负值表示从链表尾部开始计算,-1表示倒数第一个元素,返回索引数组,key不存在返回空数组
        //$a = Redis::ltrim('list1',0,-1);//截取List指定区间内(start~end)元素,成功返回true(截取的意思是,这个key只保留截取部分,相当于这个key删除了截取范围以外的值) 返回true
        //$a = Redis::lrem('list1',0,'check_1');//从List头部(count正数),或尾部(count负数),删除一定数量(count绝对值)的匹配value的元素,返回删除的元素数量int(删除元素的数量).count为0时删除全部 (注意,只能删除和value相等的值,而不能使用*来匹配所有值)
        //$a = Redis::lset('list1',0,0);//设置List中指定下标的元素值,key或者下标不存在返回错误,返回true



        //var_dump($a);
    }

    //Set类型相关命令 : Set类型用于记录一些不能重复的数据  set类型相当于一个罐子里有很多颜色的球,但是颜色不可以相同(不可以重复)
    public function setCeshi(){
        //存
        //$a = Redis::sadd('set2','2'); //添加一个String元素到key对应的set集合中,成功返回int(1),如果元素在集合中返回int(0),key对应的set不存在返回false

        //固定删,随机删,随机取,移动,成员个数,判断成员是否有
        //$a = Redis::srem('set1','2'); //从key对应set中移除给定元素,成功返回int(1),如果member在集合中不存在或者key不存在返回int(0),如果key对应的不是set类型的值返回false
        //$a = Redis::spop('set1'); //删除并返回key对应set中随机的一个元素,成功则返回的是一个数组[0=>"元素"],如果set是空或者key对应的set不存在返回空数组,如果删除了最后一个元素,那么这个set就不存在了
        //$a = Redis::srandmember('set1'); //同spop,随机取set中的一个元素,但不删除,成功返回字符串,key不存在返回false
        //$a = Redis::smove('set1','set2','3'); //smove srckey dskey member:从srckey对应set中移除member并添加到dstkey对应set中,整个操作是原子的.成功返回true,如果member在srckey中不存在返回false,如果key对应的值不是set类型,返回false
        //$a = Redis::scard('set'); //返回key对应set的int(元素个数),如果set是空或者key不存在返回int(0)
        //$a = Redis::sismember('set','2'); //判断member是否在key对应的set中,存在返回true,不存在或者key对应的set集合不存在返回false


        //取交集,并集,差集 将交集,并集,差集存到另一个新set
        //$a = Redis::sinter(['set1','set2']); //返回所有给定key的交集,可以['set1','set2','set3']这样放在数组中传参,也可以传多个key来传参,成功返回索引数组,没有交易返回空数组
        //$a = Redis::sinterstore(['set4','set1','set2']); //同sinter,同时将交集存到dskey对应的set集合中,可以['set1','set2','set3']这样放在数组中传参,也可以传多个key来传参,成功返回int(交集元素个数)
        //$a = Redis::sunion('set1','set2'); //返回所有给定key的并集,可以['set1','set2','set3']这样放在数组中传参,也可以传多个key来传参,成功返回索引数组
        //$a = Redis::sunionstore('set3','set2','set1'); //sunionstore dskey key1 ...keyN : 同sunion,同时把并集存到dskey对应的set集合中
        //$a = Redis::sdiff('set1','set2'); //返回所有给定key的差集(差集就是两个集合中,前面集合有后面集合不存在的元素组成的集合)
        //$a = Redis::sdiffstore('set3','set1','set2'); //sdiffstore dskey key1 ...keyN : 同diff,同时把差集保存到dskey对应的set集合中,可以['set1','set2','set3']这样放在数组中传参,也可以传多个key来传参


        //取所有值
        //$a = Redis::smembers('set1'); //smembers key : 返回key对应set的所有元素,结果是无序的
        //var_dump($a);
    }

    //Sorted Set类型相关命令 : 不可以有重复元素,但是可以有相同sorce,(注意,相等的score也是有存的先后顺序的,根据score由大到小或者由小到大排序取出时候,score相等那就按照存时候的先后顺序去取)   Sorted Set类型相当于一个罐子里有很多颜色的球,颜色不可以相同,而且球上有对应的数字,数字可以相同
    public function SortedSetCeshi(){
        //存
        //$a = Redis::zadd('sortedSet1',3,'ruiqing'); //zadd key score member : 添加元素member到集合,元素在集合中存在则对应更新对应score,成功返回int(1)


        //固定删,删下标区间,删score区间
        //$a = Redis::zrem('sortedSet1','bao'); //zrem key member : 删除指定元素,成功返回int(1),如果key不存在或者元素不存在返回int(0),删除最后一个元素后,这个SortedSet就不存在了
        //$a = Redis::zremrangebyrank('sortedSet1',1,2); //zremrangebyrank key min max : 删除集合中下标(注意不是score,是对应下标)在给定区间的元素,返回int(删除个数)
        //$a = Redis::zremrangebyscore('sortedSet1',0,2); //zremrangebyscore key min max : 删除集合中score在给定区间的元素,返回int(删除个数)


        //score排序取元素下标,score排序取下标区间元素,取score区间元素
        //$a = Redis::zrank('sortedSet1','bao'); //zrank key member : 返回指定元素在集合中的排名(下标)注意这里不是返回socre而是排序好后的下标,集合中元素按score从小到大排序,返回int(下标)
        //$a = Redis::zrevrank('sortedSet1','bao'); //zrevrank key member : 同上,但是集合中元素按score从大到小排序,返回int(下标)
        //$a = Redis::zrange('sortedSet1',0,5); //zrange key start end : 从集合中指定区间的元素,返回结果按score顺序排列,返回索引数组
        //$a = Redis::zrevrange('sortedSet1',0,5); //zrevrange key start end : 同上,返回结果按score逆序排序,返回索引数组
        //$a = Redis::zrangebyscore('sortedSet1',0,5); //zrangebyscore key min max : 返回集合中score在给定区间的元素,返回索引数组

        //score区间元素数量,元素个数,增加score,元素score
        //$a = Redis::zcount('sortedSet1',0,5); //zcount key min max : 返回集合中score在给定区间的数量,返回int(元素数量)
        //$a = Redis::zcard('sortedSet1'); //zcard key : 返回集合中元素个数,int(元素个数)
        //$a = Redis::zincrby('sortedSet1',3,'bao'); //zincrby key incr member : 增加对应member的score值为加incr后的值,并且重新排序,返回更新后的score值,返回float(score)
        //$a = Redis::zscore('sortedSet1','ning'); //zscore key element : 返回给定元素对应的score,返回float(score)

        //var_dump($a);
    }

    //Hash类型相关命令 : Hash类型相当于一个罐子里有很多颜色的球,颜色不能相同,并且每个球上有对应的文字或数字(key),相当于关联数组,key不可以相等,但是value可以相等
    public function hashCeshi(){
        //存取
        //$a = Redis::hset('hash1','bao','bao');//hset key field value : 设置key对应的Hash对象中指定域的值.如果key对应的Hash对象不存在,将创建此Hash对象.成功返回int(1),如果指定的域已经存在,其值将被重写,但是重写时候返回int(0)
        //$a = Redis::hget('hash1','3');//hget key field : 返回与field域关联的值,成功返回字符串,如果该域不存在或者key对应的Hash对象不存在,返回false
        //$a = Redis::hmget('hash1','1','2','3','bao');//hmget key field1...fieldN : 返回存储在key对应的Hash对象中各个指定域相关联的值,成功返回索引数组.对于在Hash对象中不存在的域,索引数组中对应false
        //$a = Redis::hmset('hash1','1','1');//hmset key field1 value1 ... fieldN valueN : 设置存储在key对应的Hash对象中指定域的值.该命令会复写Hash中已经存在的域.如果key对应的Hash对象不存在,将创建此Hash对象,成功返回true

        //获取hash所有key,获取hash所有value,获取hash所有值
        //$a = Redis::hkeys('hash1');//hkeys key : 返回key对应的Hash对象中所有field名称
        //$a = Redis::hvals('hash1');//hvals key : 返回对应的Hash对象中所有值
        //$a = Redis::hgetall('hash1');//hgetall key : 返回key对应的Hash对象中所有域和相关联的值.在返回值中,每个域名称后面跟着相关联的值,返回关联数组(这个非常好)

        //域对应值自增,判断域存在,删除域,hash长度
        //$a = Redis::hincrby('hash1','bao','5');//hincrby key field integer : 将存储在key对应的Hash对象中field域相关联的值加上由integer指定的值.成功则返回加上integer后的值,如果key对应的Hash对象不存在,则创建此Hash对象.如果field域不存在或者具有一个不能表示为整形的字符串值,则返回false
        //$a = Redis::hexists('hash1','bao');//hexists key field : 查看指定field域是否已经存在,存在返回true,否则返回false
        //$a = Redis::hdel('hash1','2','3');//hdel key field : 删除指定的field域,返回1.如果指定的域不存在或者key不存在,返回0,可以填多个域,成功则返回删除的数量,int(删除域的数量)
        //$a = Redis::hlen('hash1');//hlen key : 返回key对应的Hash对象中field数,成功返回int(域的数量),如果key不存在,返回值为0

        //var_dump($a);
    }


























}