<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateApplication extends Mailable
{
    use Queueable, SerializesModels;

    public $applicationData;
    public $jobPost;

    public function __construct($applicationData, $jobPost)
    {
        $this->applicationData = $applicationData;
        $this->jobPost = $jobPost;
    }

    public function build()
    {
        return $this->subject('New Job Application')
            ->view('emails.candidate-application');
    }
}
