<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GitCSController extends Controller {
    //git常用
    public function zongjie() {
        //github账号:879926694@qq.com   密码:bao1ning123

        //git clone git@github.com:michaelliao/gitskills.git(参数为下载的地址)

        /*
            基本操作
            git add .
            git commit -m "..."
            git tag  (然后SHIFT+G看最后版本)
            git tag "v...." //打标签
            git push origin master --tags

            Git status 查看状态
            Git diff  查看不同
         * */



        /*
            C:\Users\Administrator\.ssh windows公钥的位置
            1. 首先查看C:\Users\Administrator\.ssh 有没有,如果没有则创建ssh key的命令 ssh-keygen -t rsa -C "youremail@example.com"
            2. 进入C:\Users\Administrator\.ssh,打开id_rsa.pub公钥文件
         * */

        /*
            git查看用户名和邮箱地址:
            git config user.name
            git config user.email
            git修改用户名和邮箱地址
            git config --global user.name "username"
            git config --global user.email "email"
         * */


        /*
        如果上传下拉需要账号密码,先打命令 : git config --global credential.helper store ,然后重新pull,打一遍账号密码,就记住了,下次就不需要打账号密码了

        查看远程库信息 1.git remote(就是获取上传的名字)  2.git remote -v(就是获取上传的名字和链接)
         * */


    }


    //如果要给一个项目创建git库
    public function newProject(){
        //在github上创建了一个新的库后
        /*
           项目根目录下操作(github创建新库后,也会有提示这样操作)
           git init
           git add README.md
           git commit -m "first commit"
           git branch -M main
           git remote add origin https://github.com/879926694/offer.git
           git push -u origin main
        * */
    }

    //忽略文件
    public function gitignore(){
        /*
            Git忽略文件
            在项目的根目录（跟.git文件夹所在目录同层）建立.gitignore文件，在里面声明即可。 
            譬如我要忽略当前项下的所有dll文件，及runtime文件夹里所有文件： 
            #ignore these files 
            *.dll 
            runtime/* 
            如果之前文件已提交过，则需要先清除原文件，针对上文做的清理如下： 
            $ git rm *.dll 
            $ git rm -r runtime 
         * */
    }

    //git分支
    public function branch(){
        /*
         分支操作的流程 : 建立分支->切换分支->在新分支中git pull origin master与主分支代码保持一致->写代码,然后add + commit(注意在这里push则github上会新建一个分支,不push的话分支属于你自己本地)->切换到master分支此时新代码不会出现在master分支,新代码属于新分支,git merge 新分支,则新代码合并到master分支,此时也不需要再次commit了,直接git push origin master就可以了,然后github上查看master分支,则会出现新分支commit提交的版本
        注意 : 在新的分支写代码,如果此时该分支没有add 和 commit,则切换到master分支时候,新代码也会出现在master分支,但是是master分支未提交状态,可以在master分支提交,提交后切换到新分支,新代码就没有了,因为属于master分支提交了,此时需要git pull origin master来和master分支保持一致,否则在master分支合并时候容易冲突

        1.git checkout -b dev(分支名)  : 这个操作是,创建dev分支,并切换到dev分支上(注意:在dev分支上进行了push origin master其实没影响,如果master分支没有新版本,那么git会告诉你master分支没什么可提交的)
        注:1的操作可以分为两步  1.git branch dev(创建dev分支)  2.git checkout dev(切换到dev分支)
        2.git branch  : 这个操作是分支,其中*指向的是当前分支
        3.如果你想讲dev分支合并到master分支,需要先切换到master分支,然后 git merge dev 就是将dev分支合并到master分支
        4.git branch -d dev 删除dev分支

        如果在你建的分支上,已经add+commit了,但是这时告诉你,不需要合并了,这个分支不要了,你要删除 但是git branch -d 分支名 这个操作不能用,因为git会提醒你,这个分支未合并,所以需要用强制删除 git branch -D 分支名(这个操作就是将小写d,变成了D,就是强制删除分支)

        在本地创建和远程分支对应的分支，使用git checkout -b branch-name origin/branch-name，本地和远程分支的名称最好一致；
        建立本地分支和远程分支的关联，使用git branch --set-upstream-to=origin/dev dev


        查看分支合并图  1.git log --graph --pretty=oneline --abbrev-commit     2.git log --graph
     * */
    }

    //git工作现场
    public function stash(){
        /*
        如果有未完成的工作,但是突然有个bug需要修改,需要暂存工作区现场,以便之后操作:
        操作方法: 1.如果手里工作未完成,不能做提交操作,那么可以 : git stash(这个操作可以保存工作区现场,而且git status检查状态时,工作区是干净的)
              2.这样就可以切换到master分支去修改bug了
              3.然后回到自己分支工作时,需要恢复之前的工作现场 : 可以先用 git stash list(查看保存的工作现场列表)
              4.恢复工作现场的方法: (1)git stash apply stash@{0}(这个参数是需要恢复的某个现场,但是这么做,stash的记录没有删除)   git stash dropstash@{0}(这个参数是需要恢复的某个现场) 删除这个工作现场
                        (2)git stash pop stash@{0} (恢复工作现场的同时,删除这个工作现场的保存记录)

         * */
    }


    //git回滚方法
    public function rollback(){
        /*
            如果你的代码修改的有错误
            1.如果你只是修改了代码,还没有 git add .  :
            方法: git checkout -- .(如果参数是'.',就是将工作区所有的修改还原为未修改状态,也可以是写文件名称,就是将该文件的修改还原)

            2.如果你已经 git add . 了(就是添加到暂存区了)
            方法: git reset HEAD .(.的作用就是所有,也可以是文件名),这样就是把暂存区放回工作区,然后再用方法1,就可以了

            3.已经git commit origin master了,可以版本回退 git reset --hard (HEAD^或者版本号)，不过前提是没有推送到远程库
         * */



        /*
         如果已经推送到远程库 : 版本强制回退方法
            第一种方法 : 首先git log --pretty=oneline查看你要回退的版本号,然后git reset --hard HEAD^,这样就回退版本了,注意这里写的版本号是你要回退到的版本,但是已经push的版本会提示你落后几个版本,需要pull,这个时候就git push -f -u origin master,强制提交到远程,这样的坏处是比如你有11个提交,这样一来后面的提交全部没有了
            第二种方法 : 如果你现在的版本是最新的版本,你要退回到上一个版本,则可以 git revert -n 想要舍弃的版本号,这样代码就回到了上一次提交时候的状态,然后commit + push提交,这样有个好处就是所有版本都在,不会影响后面提交版本的代码,而且可以提交一个新版本,就是回退后的版本    这种方法叫反做,就是将此次增加的代码,再减回到上一次提交,但是如果之后也有提交,那么就会有冲突的可能,解决冲突在提交就可以
         * */
    }

    //git标签
    public function tag(){
        /*
         标签 : tag就是一个让人容易记住的有意义的名字，它跟某个commit绑在一起
            Git tag 查看所有标签
            git show <tagname>可以看到标签说明文字

         命令git tag <name>用于新建一个标签，默认为HEAD，也可以指定一个commit id；   git tag v0.9 f52c633  对某一次commit提交打标签
           git tag -a <tagname> -m "此处打注释" 可以指定标签信息；     git tag -a v0.1 -m "version 0.1 released" 1094adb
           git tag -s <tagname> -m "blablabla..."可以用PGP签名标签；(这个不懂)
           git tag可以查看所有标签。

       删除标签:1.删除本地标签 git tag -d 标签名(版本名)
            2.可以将本地的标签推到远程 : git push origin v1.0(这是上传本地v1.0标签到远程)
                         git push origin --tags(这是上传本地所有标签到远程)
            3.要删除已经上传的远程的标签: 1.首先删除本地标签(git tag -d 标签名)
                          2.然后删除远程 (git push origin :refs/tags/标签名)


         * */
    }

}