<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\DateTimeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AdminController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     protected $user;
    protected $settings;
    public function __construct()
    {
        $this->user = Auth::user();
        $this->settings = Settings::first();
        if($this->user){
        if($this->user->user_type != "Admin"){
            
            $error = array("code" => "403",
                   "title" => "Forbidden!",
                   "message" => "You do not have the user privilage to this page! Meanwhile, you can return to index page by clicking",
                   "link" => url('/') );
                   return view('home.error', ['settings' => $this->settings, 'errors' => $error]);    
        }
    }else{
        $error = array("code" => "403",
        "title" => "Forbidden!",
        "message" => "You do not have the user privilage to this page! Meanwhile, you can return to index page by clicking",
        "link" => url('/') );
        return view('home.error', ['settings' => $this->settings, 'errors' => $error]);    

    }
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
