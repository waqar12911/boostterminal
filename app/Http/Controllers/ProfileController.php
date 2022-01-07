<?php

namespace App\Http\Controllers;

use App\Models\ClientData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\User;
use Swift_Mailer;
use Swift_SmtpTransport;
use Mail;
use DB;
use Auth;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */

    public function edit()
    {
        $data=ClientData::all();
        return view('users.client-home',compact('data'));
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

     public function admin_password_update(Request $request)
    {
         $request->validate([
            'verify_code' => 'required',
            'password' => 'required|min:6|string|same:password_confirmation',
        ]);
        User::where('id',Auth::user()->id)->where('verify_email_code',$request->verify_code)->update(['password' => Hash::make($request->password)]);

        return redirect()->route('showAdminInfo')->with('message',__('Password successfully updated.'));
    }

    public function password_2fa()
    {
        $user=Auth::user();
        $id=$user->id;
        $transport = new Swift_SmtpTransport('mail.nextlayer.live', 587, 'tls');
        $transport->setUsername('outgoing@nextlayer.live');
        $transport->setPassword('Bitcoin2020$');
        $swift_mailer = new Swift_Mailer($transport);
        Mail::setSwiftMailer($swift_mailer);
         $reciever_email = 'nayomiaaler@gmail.com';       
         $sender_email = 'outgoing@nextlayer.live';
        $subject = 'Nextlayer Mainframe Password Change Code';    

        $data['verify_email_code'] = $this->RandomString();
               
         DB::table('users')->where('id',$id)->update([
                   "verify_email_code" => $data['verify_email_code']
                   ]);
         Mail::send(['html'=>'emails.reset_password'], $data, function($message) use($reciever_email , $sender_email, $subject ) {
                    $message->to($reciever_email, 'Nextlayer Sovereign')->subject
                    ($subject);
                    $message->from($sender_email,$sender_email);
                });
         $code=true;
         return view('profile.change-password',compact('code'));

    }

    public function verify_2fa(Request $request)
    {
        $request->validate([
            'verify_code' => 'required',
        ]);
        $user=User::where('id',Auth::user()->id)->where('verify_email_code',$request->verify_code)->first();
        if($user)
        {
            return view('profile.change-password');
        }
        else
        {
            return redirect()->back()->with('error','Verification code does not match.');
        }
        

    }
    public function RandomString()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 5; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        return strtoupper($randstring);
    }
}
