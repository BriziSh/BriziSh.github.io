<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        //shto edhe rregulla te tj me von per cel dhe adresen
        // dd($this->getPathInfo()=='/authenticateUser');
        // dd($this->getPathInfo()=='/createUser');

        if($this->getPathInfo()=='/change_password' || $this->getPathInfo()=='/change_user_password'){
            return [
                "old_pass"=>"required|min:8|max:20",
                "new_pass"=>"required|confirmed|min:8|max:20"
            ];
        }

        if($this->getPathInfo()=='/account_settings' || $this->getPathInfo()=='/account_profile'){
            return [
                "name"=>"required|min:3|max:20", 
                "phone"=>"nullable"
            ];
        }
        if($this->getPathInfo()=='/createUser'){
            return [
                "name"=>"required|min:3|max:20", 
                "email"=>"required|email|unique:users,email",
                "password"=>"required|confirmed|min:8|max:20",
                "phone"=>"nullable",
                "image"=>"nullable"
            ];
        }
        if($this->getPathInfo()=='/authenticateUser'){
            return [
                "email"=>"required|email",
                "password"=>"required|min:8|max:20"
            ];
        }
        if($this->getPathInfo()=='/confirm_new_password'){
            return [
                "email"=>"required|email",
                "password"=>"required|confirmed|min:8|max:20",
            ];
        }
    }
}
