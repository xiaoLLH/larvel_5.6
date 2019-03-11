<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use phpspider\core\phpspider;

require __DIR__.'/../../../vendor/owner888/phpspider/autoloader.php';

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            /* Do NOT delete this comment */
            /* 不要删除这段注释 */
            $configs = array(
                'name' => '糗事百科',
                'log_type' => 'info',
//            'interval' => 1000,
                'max_fields' => 100,
                'domains' => array(
                    'qiushibaike.com',
                    'www.qiushibaike.com'
                ),
                'scan_urls' => array(
                    'http://www.qiushibaike.com/8hr/page/1'
                ),
                'content_url_regexes' => array(
                    "http://www.qiushibaike.com/8hr/page/\d+"
                ),
                'list_url_regexes' => array(
//                "http://www.qiushibaike.com/8hr/page/\d+"
                ),
                'export' => array(
                    'type' => 'sql',
                    'file' => './data/llh.csv', // data目录下
                ),
                'fields' => array(
                    array(
                        // 抽取内容页的文章内容
                        'name' => "recmd-content",
                        'selector' => "//a[@class='recmd-content']",
                        'required' => true,
                        'repeated' => true
                    ),
                    array(
                        // 抽取内容页的文章作者
                        'name' => "recmd-name",
                        'selector' => "//span[@class='recmd-name']",
                        'required' => true,
                        'repeated' => true
                    ),
                ),
            );
            $spider = new phpspider($configs);
            $spider->start();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
