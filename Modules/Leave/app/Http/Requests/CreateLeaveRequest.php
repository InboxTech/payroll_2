<?php

namespace Modules\Leave\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateLeaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'leave_type_name' =>'required',
            'number_of_leaves' => 'required|numeric',
        ];
    }

    public function messages(): array 
    {
        return [
            'leave_type_name.required' => 'Leave type name is required',
            'number_of_leaves.required' => 'Number of leaves is required',
            'number_of_leaves.numeric' => 'Number of leaves must be a number',
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
