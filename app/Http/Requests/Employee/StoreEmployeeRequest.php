<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->hasPermission('createEmployees');
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->filled('passport_number')) {
            $this->merge([
                'passport_number' => strtoupper($this->passport_number)
            ]);
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'            => ['required', 'string', 'min:2'],
            'job_number'      => ['nullable', 'string', 'between:5,6', 'unique:employees,job_number'],
            'management_id'   => ['nullable', 'integer'],
            'passport_number' => ['nullable', 'string', 'regex:/^[A-Z0-9]{6,9}$/', 'unique:employees,passport_number'],
            'id_number'       => ['nullable', 'numeric', 'digits:10', 'unique:employees,id_number'],
            'expiry_date_id'  => ['nullable', 'date', 'after:today'],
            'phone_number'    => ['nullable', 'digits:10', 'unique:employees,phone_number'],
            'nationality_id'  => ['nullable', 'integer'],
            'is_active'       => ['nullable'],
            'company_id'      => ['nullable', 'integer'],
            'job_title_id'    => ['nullable', 'integer']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'يجب إدخال الاسم!',
            'name.min' => 'يجب أن يكون الاسم من حرفين على الأقل!',
            'job_number.between' => 'يجب أن يكون الرقم الوظيفي من 5 أو 6 خانات!',
            'job_number.unique' => 'هذا الرقم الوظيفي مسجل من قبل!',
            'passport_number.regex' => 'رقم الجواز يجب أن يكون: من 6 إلى 9 خانات - لا يحتوى إلا على أرقام أو حروف انجليزية',
            'passport_number.unique' => 'رقم جواز السفر مسجل من قبل!',
            'id_number.digits' => 'رقم الهوية مكون من 10 أرقام بالضبط!',
            'id_number.unique' => 'رقم الهوية مكرر!',
            'expiry_date_id.after' => 'الهوية منتهية!',
            'phone_number.digits' => 'رقم الجوال يجب أن يتكون من 10 أرقام بالضبط!',
            'phone_number.unique' => 'رقم الجوال مكرر!'
        ];
    }
}
