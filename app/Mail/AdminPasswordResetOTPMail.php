<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;
use App\Models\Settings;
use App\Models\AdminVerification;

class AdminPasswordResetOTPMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        //$controller = new controller();
        $emailContent = EmailTemplate::where('title', 'Reset Password OTP Mail')->get()->first();
        $verifyCode = AdminVerification::insertEmailCode($this->data->id)->email_code;
        //
        $siteInfo = Settings::single();

        $search = array('{NAME}', '{EMAIL_CODE}');
        $replace = array($this->data->first_name, $verifyCode);

        $body = str_replace($search, $replace, $emailContent->content);

            // $array = array(
            // 'receiverName' => $this->data->name,
            // 'site_url' => $siteInfo->site_url,
            // 'site_name' => $siteInfo->site_name,
            // 'site_logo' => $siteInfo->site_logo,
            // 'title' => $emailContent->title,
            // 'emailContent' => $body,
            // 'signature' => $emailContent->footer
            // );

        return $this->from($siteInfo->email, $emailContent->title)
        ->view('mails.generic', ['receiverName' => $this->data->first_name,
        'site_url' => $siteInfo->site_url,
        'site_name' => $siteInfo->site_name,
        'site_logo' => $siteInfo->site_logo,
        'title' => $emailContent->title,
        'emailContent' => $body,
        'signature' => $emailContent->footer]);
    }
}
