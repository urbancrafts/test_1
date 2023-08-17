<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EmailTemplate;
use App\Models\Settings;
use App\Models\User;
use App\Models\Customer;

class DeviceDetectionMail extends Mailable
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
        $emailContent = EmailTemplate::where('title', 'Device Loggedin Detection')->get()->first();
        if(count(User::where('email', $this->data->email)->get()) > 0){
        $user = User::where('email', $this->data->email)->get();
        }else{
        $user = Customer::where('email', $this->data->email)->get();
        }
        //
        $siteInfo = Settings::single();

        $search = array('{NAME}', '{MESSAGE}', '{CHANGED}', '{CHANGED_DATA}');
        $replace = array($user[0]->first_name, $this->data->message, $this->data->changed, $this->data->changed_data);

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
        ->view('mails.device_login', [
        'user_id' => $user[0]->id,
        'site_url' => $siteInfo->site_url,
        'site_name' => $siteInfo->site_name,
        'site_logo' => $siteInfo->site_logo,
        'title' => $emailContent->title,
        'emailContent' => $body,
        'signature' => $emailContent->footer]);
    }
}
