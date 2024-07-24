<?php

namespace Modules\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $userId = $this->route('user');
        // dd($userId->toArray());

        return [
            'first_name' =>'required',
            'last_name' =>'required',
            'email' =>'required|email|unique:users,email,' . $this->user->id,
            'password' =>'required|min:8|same:confirm_password',
            'confirm_password' =>'required',
            'mobile_no' =>'required|numeric|digits:10|unique:users,mobile_no,' . $this->user->id,
            'role_id' =>'required',
        ];
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'Please Enter First Name',
            'last_name.string' => 'Please Enter Last Name',
            'email.required' => 'Please Enter Email',
            'email.email' => 'Invalid Email',
            'email.unique' => 'This Email All Ready Exists. Please Use Another',
            'mobile_no.required' => 'Please Enter Mobile Number',
            'mobile_no.numeric' => 'Enter Valid Mobile Number',
            'mobile_no.digits' => 'Please Enter 10 digit Mobile Number',
            'password.required' => 'Please Enter Password',
            'password.min' => 'Password must be at least 8 characters',
            'password.same' => 'Password and Confirm Password does not match',
            'confirm_password.required' => 'Please Enter Confirm Password',
            'role_id.required' => 'Please Select Role',            
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
