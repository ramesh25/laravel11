<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermissionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
<<<<<<< HEAD
    {
        $permissionId = $this->route('permission'); // or $this->permission
=======
    {   
        $permissionId = $this->route('permission');
>>>>>>> 0dd5e1624b3f993759dfa50f0255d37b18785ffa
        return [
             'name' => [
                'required',
                Rule::unique('permissions', 'name')->ignore($permissionId),
            ],
        ];
    }
}
