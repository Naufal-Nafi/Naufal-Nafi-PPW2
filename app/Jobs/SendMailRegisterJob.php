<?php

namespace App\Jobs;

use App\Mail\SendEmailRegister;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendMailRegisterJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::find($this->data['id']);
        $registrationDate = $user->created_at->format('d F Y, H:i');

        $emailData = [
            'email' => $user->email,
            'name' => $user->name,
            'registration_date' => $registrationDate, // Tambahkan tanggal registrasi
        ];

        $email = new SendEmailRegister($emailData);
        Mail::to($this->data['email'])->send($email);
    }
}
