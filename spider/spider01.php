<?php
require __DIR__ . '/../vendor/owner888/phpspider/autoloader.php';

class spider01
{
    /**
     * 初级测试糗事百科
     */
//    public function index(){
//        /* Do NOT delete this comment */
//        /* 不要删除这段注释 */
//        $configs = array(
//            'name' => '糗事百科',
//            'log_type' => 'info',
////            'interval' => 1000,
//            'max_fields' => 100,
//            'domains' => array(
//                'qiushibaike.com',
//                'www.qiushibaike.com'
//            ),
//            'scan_urls' => array(
//                'http://www.qiushibaike.com/8hr/page/1'
//            ),
//            'content_url_regexes' => array(
//                "http://www.qiushibaike.com/8hr/page/\d+"
//            ),
//            'list_url_regexes' => array(
////                "http://www.qiushibaike.com/8hr/page/\d+"
//            ),
//            'export' => array(
//                'type' => 'csv',
//                'file' => './data/llh.csv', // data目录下
//            ),
//            'fields' => array(
//                array(
//                    // 文章标题
//                    'name' => "recmd-content",
//                    'selector' => "//a[@class='recmd-content']",
//                    'required' => true,
//                    'repeated' => true
//                ),
//                array(
//                    // 文章作者
//                    'name' => "recmd-name",
//                    'selector' => "//span[@class='recmd-name']",
//                    'required' => true,
//                    'repeated' => true
//                ),
//            ),
//        );
//        $spider = new \phpspider\core\phpspider($configs);
//        $spider->start();
//    }
    /**
     * 爬取一页数据
     */
//    public function crawl_page(){
//        /* Do NOT delete this comment */
//        /* 不要删除这段注释 */
//        $configs = array(
//            'name' => '糗事百科',
////            'log_type' => 'info',
//            'domains' => array(
//                'qiushibaike.com',
//                'www.qiushibaike.com'
//            ),
//            'scan_urls' => array(
//                'http://www.qiushibaike.com/8hr/page/1'
//            ),
//            // 只爬取第一页的数据
//            'content_url_regexes' => array(
//                "http://www.qiushibaike.com/8hr/page/1$"
//            ),
//            // 可以不设置  或者如下设置 不然 都会爬取 1开头的
//            'list_url_regexes' => array(
////                "http://www.qiushibaike.com/8hr/page/1$"
//            ),
//            'export' => array(
//                'type' => 'csv',
//                'file' => './data/llh.csv', // data目录下
//            ),
//            'fields' => array(
//                array(
//                    // 文章标题
//                    'name' => "recmd-content",
//                    'selector' => "//a[@class='recmd-content']",
//                    'required' => true,
//                    'repeated' => true
//                ),
//                array(
//                    // 文章作者
//                    'name' => "recmd-name",
//                    'selector' => "//span[@class='recmd-name']",
//                    'required' => true,
//                    'repeated' => true
//                ),
//            ),
//        );
//        $spider = new \phpspider\core\phpspider($configs);
//        $spider->start();
//    }
    /**
     * 爬取一页数据的详情
     */
    public function crawl_page_detail()
    {
        /* Do NOT delete this comment */
        /* 不要删除这段注释 */
        $configs = array(
            'name' => '糗事百科',
            'domains' => array(
                'qiushibaike.com',
                'www.qiushibaike.com'
            ),
            'scan_urls' => array(
                'http://www.qiushibaike.com/8hr/page/1'
            ),
            'content_url_regexes' => array(
                "http://www.qiushibaike.com/8hr/page/\d+",
            ),
            'list_url_regexes' => array(
                "http://www.qiushibaike.com/8hr/page/\d+",
            ),
            'export' => array(
                'type' => 'csv',
                'file' => './data/llh.csv', // data目录下
            ),
            'fields' => array(
                array(
                    // 文章标题
                    'name' => "recmd-right",
                    'selector' => "//div[@class='recmd-right']",
                    'required' => true,
                    'repeated' => true,
                ),
            ),
        );
        $spider = new \phpspider\core\phpspider($configs);
        $spider->on_extract_field = function ($fieldname, $data, $page) {
            if ("recmd-right" == $fieldname) {
                $string = "";
                if(is_array($data)){
                    foreach ($data as $data_val){
                        $content_url = \phpspider\core\selector::select($data_val, '//a[@class="recmd-content"][last()]/attribute::href');
                        $url = "http://www.qiushibaike.com{$content_url}";
                        $content = \phpspider\core\requests::get($url);
                        $page_views = \phpspider\core\selector::select($content, '//*[@id="single-next-link"]');
                        $string .= "抓取链接：".$url;
                        $string .= PHP_EOL."抓取的内容页：".$page_views.PHP_EOL;
                    }
                }else{
                    $content_url = \phpspider\core\selector::select($data, '//a[@class="recmd-content"][last()]/attribute::href');
                    $url = "http://www.qiushibaike.com{$content_url}";
                    $content = \phpspider\core\requests::get($url);
                    $page_views = \phpspider\core\selector::select($content, '//*[@id="single-next-link"]');
                    $string .= "抓取链接：".$url;
                    $string .= PHP_EOL."抓取的内容页：".$page_views.PHP_EOL;
                }
                return $string;
            }
            return $data;
        };
        $spider->start();
    }
}

$model = new spider01();

$model->crawl_page_detail();


