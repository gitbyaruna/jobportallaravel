<?php

namespace App\Mail;

use App\Models\Application;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ApplicationSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $application;

    /**
     * Create a new message instance.
     *
     * @param \App\Models\Application $application
     * @return void
     */
    public function __construct(Application $application)
    {
        $this->application = $application;  // Store application details to be passed to the view
    }

    /**
     * Build the message.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        return $this->subject('New Job Application')
                    ->view('emails.application_submitted') // Specify the email view
                    ->with([
                        'name' => $this->application->name,
                        'email' => $this->application->email,
                        'phone' => $this->application->phone,
                        'address' => $this->application->address,
                        'position' => $this->application->position,
                    ]);
    }
}
