<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\SendMail;
use Mail;

class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:send-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Mail';

    protected $data       = array();

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($data = array())
    {
        parent::__construct();
        $this->data = $data;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    { 
        Mail::to($this->data['to_email'])->send(new SendMail($this->data));
    }
}
