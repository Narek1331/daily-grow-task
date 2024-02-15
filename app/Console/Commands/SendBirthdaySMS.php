<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User; 
use Carbon\Carbon;
use App\Services\SmscService; 

class SendBirthdaySMS extends Command
{
    protected $signature = 'birthday:sms';
    protected $description = 'Send SMS notification 7 days before user birthday';

    public function __construct(SmscService $smsc_service)
    {
        parent::__construct();
        $this->smsc_service = $smsc_service;
    }

    public function handle()
    {
        $currentMonth = now()->month;

        $users = User::whereRaw("MONTH(STR_TO_DATE(dob, '%d.%m.%y')) = ?", [$currentMonth])
             ->where(function ($query) {
                 $query->whereRaw("DAY(STR_TO_DATE(dob, '%d.%m.%y')) = ?", [now()->day])
                       ->orWhereRaw("DAY(STR_TO_DATE(dob, '%d.%m.%y')) = ?", [now()->addDays(1)->day])
                       ->orWhereRaw("DAY(STR_TO_DATE(dob, '%d.%m.%y')) = ?", [now()->addDays(2)->day])
                       ->orWhereRaw("DAY(STR_TO_DATE(dob, '%d.%m.%y')) = ?", [now()->addDays(3)->day])
                       ->orWhereRaw("DAY(STR_TO_DATE(dob, '%d.%m.%y')) = ?", [now()->addDays(4)->day])
                       ->orWhereRaw("DAY(STR_TO_DATE(dob, '%d.%m.%y')) = ?", [now()->addDays(5)->day])
                       ->orWhereRaw("DAY(STR_TO_DATE(dob, '%d.%m.%y')) = ?", [now()->addDays(6)->day])
                       ->orWhereRaw("DAY(STR_TO_DATE(dob, '%d.%m.%y')) = ?", [now()->addDays(7)->day]);
        })->
        whereHas('newsletters', function ($query) {
            $query->where('type', 'daily_7_days_before_birthday');
        })
        ->with(['newsletters' => function ($query) {
            $query->where('type', 'daily_7_days_before_birthday');
        }])
        ->get();
        foreach ($users as $user) {
            foreach($user->newsletters as $newsletter){
                $this->smsc_service->sendMessage($user['phone_number'],$newsletter['text']);
            }
        }

        $this->info('Birthday SMS notifications sent successfully.');
    }
}
