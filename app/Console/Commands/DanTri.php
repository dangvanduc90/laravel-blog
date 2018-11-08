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

class DanTri extends Command
{
    protected $signature = 'dantri';
    protected $description = 'Mô tả code lấy bài đăng từ Dân trí';

    /**
     *
     */
    public function handle()
    {
        \Log::info("I was Dân trí: " . Carbon::now());
        $this->info("I was Dân trí");
    }
}
