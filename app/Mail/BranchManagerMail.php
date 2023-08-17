<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;
use App\Models\Settings;
use App\Models\User;

class BranchManagerMail extends Mailable
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
        $emailContent = EmailTemplate::where('title', 'Branch Manager')->get()->first();
        //$verifyCode = UserVerification::insertEmailCode($this->data->id)->email_code;
        //

        $user = User::where('id', $this->data->admin_user)->get();

        $siteInfo = Settings::single();

        $search = array('{NAME}', '{SITE_NAME}', '{ADMIN_NAME}', '{SITE_LINK}', '{PASSWORD}');
        $replace = array($this->data->first_name, $siteInfo->site_name, $user[0]->first_name.' '.$user[0]->last_name, $siteInfo->site_url, $this->data->none_hsh);

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
