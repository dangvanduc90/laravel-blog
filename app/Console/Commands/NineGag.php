<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/7/2018
 * Time: 3:40 PM
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;

class NineGag extends Command
{
//    protected $signature = 'ninegag {user} {--queue=}';
//    protected $signature = 'ninegag {user?} {--queue=}'; // not required
    protected $signature = 'ninegag {user=foo} {--queue=default_queue}'; // default argument + options
//    protected $signature = 'ninegag {user*} {--queue=default_queue}'; // array argument
//    protected $signature = 'ninegag {user?} {--queue=*}'; // array options
//    protected $signature = 'ninegag {user : The name of the user} {--queue= : Whether queue}'; // Input Descriptions

    protected $description = 'Mô tả code lấy bài đăng từ 9Gag';

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    /**
     * @param $args
     * @return string
     */
    private function generateText($args)
    {
        if (is_array($args)) {
            return json_encode($args);
        }
        return $args;
    }

    public function handle()
    {
        \Log::info(
            "NineGag: " . $this->generateText($this->argument('user')) . " and " .
            $this->generateText($this->option('queue'))
        );

//        $this->call('dantri'); // call other commands

        $this->info(
            "NineGag: " . $this->generateText($this->argument('user')) . " and ".
            $this->generateText($this->option('queue'))
        );
    }
}
