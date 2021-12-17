<?php

namespace App\Console\Commands;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

use Illuminate\Console\Command;

class PromotionalEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'promotional:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cron job for sending promotional email';

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
     * @return int
     */
    public function handle()
    {
        Mail::to('pravin@vivanshinfotech.com')->send(new SendMail());
    }
}
