<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 11/7/2018
 * Time: 3:40 PM
 */

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;

class NineGag extends Command
{
    protected $signature = 'ninegag';
    protected $description = 'Mô tả code lấy bài đăng từ 9Gag';

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
        \Log::info("I was here NineGag: " . Carbon::now());
        return "Code lấy bài đăng từ 9Gag";
    }
}
