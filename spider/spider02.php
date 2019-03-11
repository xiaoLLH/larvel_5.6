<?php
require __DIR__ . '/../vendor/owner888/phpspider/autoloader.php';
class spider02{
    public function index($url = "https://www.qiushibaike.com/imgrank/"){
        $html = \phpspider\core\requests::get($url);
        // 选择器规则
        $selector = '//div[@class="thumb"]/a/img';
        // 提取 图片 结果
        $img_list = \phpspider\core\selector::select($html, $selector);
//        var_dump($img_list);
        // 选择器规则
        $selector = '//h2';
        // 提取 作者 结果
        $zuozhe_list = \phpspider\core\selector::select($html, $selector);
//        var_dump($zuozhe_list);
        // 选择器规则
        $selector = '//*[@class="author clearfix"]/a[1]/img';
        // 提取 作者 结果
        $zuozhe_img = \phpspider\core\selector::select($html, $selector);
    }
}
(new spider02())->index();