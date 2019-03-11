<?php

namespace App\Http\Controllers;

use App\Contracts\TestContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use phpspider\core\phpspider;

class SpiderController extends Controller
{
    public function index(){
        /* Do NOT delete this comment */
        /* 不要删除这段注释 */
        $configs = array(
            'name' => '简书',
            'log_show' =>false,
            'tasknum' => 1,
        //数据库配置
            'db_config' => array(
                'host'  => '127.0.0.1',
                'port'  => 3306,
                'user'  => 'root',
                'pass'  => 'mysqlpw',
                'name'  => 'demo',
            ),
            'export' => array(
                'type' => 'db',
                'table' => 'jianshu',  // 如果数据表没有数据新增请检查表结构和字段名是否匹配
            ),
        //爬取的域名列表
            'domains' => array(
                'jianshu',
                'www.jianshu.com'
            ),
        //抓取的起点
            'scan_urls' => array(
                'https://www.jianshu.com/c/V2CqjW?utm_medium=index-collections&utm_source=desktop'
            ),
        //列表页实例
            'list_url_regexes' => array(
                "https://www.jianshu.com/c/\d+"
            ),
        //内容页实例
        //  \d+  指的是变量
            'content_url_regexes' => array(
                "https://www.jianshu.com/p/\d+",
            ),
            'max_try' => 5,
            'fields' => array(
                array(
                    'name' => "title",
                    'selector' => "//h1[@class='title']",
                    'required' => true,
                ),
                array(
                    'name' => "content",
                    'selector' => "//div[@class='show-content-free']",
                    'required' => true,
                ),
            ),
        );
        $spider = new phpspider($configs);
        $spider->start();
    }
}
