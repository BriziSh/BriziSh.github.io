<?php

namespace App\Http\Controllers;

use Mail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\PasswordResetMail;
use App\Http\Requests\UserRequest;
use App\Mail\EmailVerificationMail;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LoginController extends Controller
{
    //rregulloje
    public function createUser(UserRequest $r){
        $validated = $r->validated();
        $validated['password'] = bcrypt($validated['password']);
        //shto verification code, string random me 40 char
        // $validated['email_verification_code']= Str::random(40);
        $randomString = '';
        for ($i = 0; $i < 20; $i++) {
            $randomString .= str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')[random_int(0, 61)];
        }
        $validated['email_verification_code']=$randomString;

        //Check for connection
        if($this->isOnline()){
            $user = User::create($validated);
            Mail::to($r->email)->send(new EmailVerificationMail($user));
            auth()->login($user);
            //kontrolli nese eshte admin apo jo sesh nevoja se sbehemi dot direkt admin sa regjistrohemi
            return redirect('/',201)->with('success', 'Registration successful.Please check your email address for email verification link. ');
        }
        else {
            return redirect()->back()->with('danger', 'Check your internet connection');
        }
    }
    
    public function isOnline($site='https://youtube.com/'){
        if(@fopen($site, 'r')){
            return true;
        }
        else {
            return false;
        }
    }

    public function authenticateUser(UserRequest $r){
        $validated = $r->validated();
        if(auth()->attempt($validated)){
            $r->session()->regenerate();
            return $this->chooseUsertype('User logged in successfully');
        }
        return back()->withErrors(['password'=>'Invalid credentials!']);
    }

    //shife
    public function chooseUsertype(String $str){
        if(auth()->user()->usertype==0){
            return redirect('/',201)->with('success', $str);
        }
        else{
            return redirect('/admin',201)->with('success', $str);
        }
    }

    public function logout(Request $r){
        auth()->logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect('/')->with('success','You have been logged out');
    }

    public function send_reset_password(Request $r){
        $validated = $r->validate([
            'email' => 'required|email',
        ]);
        $r->email = e($r->email);
        $user = User::where('email', '=', $validated['email'])->first();
        // try {
        //     // Your code here that might throw an exception
        //     $user = User::where('email', '=', $validated['email'])->firstOrFail();
        // } catch (ModelNotFoundException $e) {
        //     report($e); // Log the exception
        //     return response()->view('errors.user_not_found', [], 404); // Render a custom error page with a 404 status code
        // }
        
        if(!$user){
            return redirect()->back()->with('danger','Email doesnt exist');
        }

        // $reset_code = Str::random(40);
        $randomString = '';
        for ($i = 0; $i < 20; $i++) {
            $randomString .= str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')[random_int(0, 61)];
        }
        $reset_code = $randomString;

        $user->password_verification_code = $reset_code;
        $user->save();

        Mail::to($user->email)->send(new PasswordResetMail($user));
        return redirect()->back()->with('success', 'Please check your email address for the password reset link. ');
    }

    public function reset_password($verification_code){
        $user= User::where('password_verification_code','=',$verification_code)->first();
        if(!$user){
            return redirect('login')->with('danger', 'Invalid URL');
        }
        else{
            //kontrollo a e ke sakte
            $_SESSION['password_verification_code']=$verification_code;
            return view('pages.password_reset', ['user_email'=>$user->email]);
        } 
    }

    public function view_reset_password($user){
        return view('pages.password_reset', ['user'=>$user]);
    }

    public function confirm_new_password(UserRequest $r){
        $validated = $r->validated();
        $user = User::where('email', '=', $validated['email'])->first();
        if(!$user || (isset($_SESSION['password_verification_code']) && $user->password_verification_code!=$_SESSION['password_verification_code'])){
            return redirect()->back()->with('danger', 'Email is not correct');
        }
       
        $validated['password'] = bcrypt($validated['password']);
        $user->password = $validated['password'];
        $user->password_verification_code=null;
        $user->save();
        //rregullo me patjeter nje controller qe te merret vec me logimit (vecon adminet nga userat)
        auth()->login($user);
        return $this->chooseUsertype('Password changed successfully');
        //kontrolli nese eshte admin apo jo
        // return redirect('/',201)->with('success', 'Password changed successfully');

    }

    //ka qene me pare te UserController
    public function verify_email($verification_code){
        $user= User::where('email_verification_code','=',$verification_code)->first();
        if(auth()->id()==$user->id){
            if(!$user){
                return redirect('login')->with('danger', 'Invalid URL');
            }
            else{
                if($user->email_verified_at){
                    return $this->chooseUsertype('Email already verified');
                    // return redirect('/')->with('success', 'Email already verified');
                }
                else{
                    // kontrolloje iher
                    $user->email_verified_at=Carbon::now();
                    $user->update();
                    return $this->chooseUsertype('Email successfully verified');
                    // return redirect('/')->with('success','Email sucessfully verified');
                }
            } 
        }
        return redirect('login')->with('danger', 'Login first then try again to verify the email');
    }

    public function view_forgot_password(){
        return view('pages.forgot_password');
    }

    public function view_register_page(){
        return view('pages.register_page'); 
    }

    public function view_login_page(){
        return view('pages.login_page');
    }

    public function privacy_policy(){
        return view('pages.privacy_policy');
    }

    public function terms_of_use(){
        return view('pages.terms_of_use');
    }
}
