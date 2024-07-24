<?php

namespace Modules\HolidayLeave\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateHolidayLeaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'holiday_name' => 'required',
            'holiday_date' => 'required',
            'status' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'holiday_name.required' => 'Please Enter Holiday Name',
            'holiday_date.required' => 'Please Enter Holiday date',
            'status.required' => 'Please Select Status',
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
