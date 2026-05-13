<?php

namespace BalajiDharma\LaravelAdminCore\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
        return [
            'name' => 'required|max:255',
            'machine_name' => 'required|alpha_dash|lowercase|max:64|unique:'.config('menu.table_names.menus', 'menus').',machine_name',
            'description' => 'max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'machine_name.lowercase' => 'The machine name must only contain lowercase letters, numbers, dashes and underscores.',
            'machine_name.alpha_dash' => 'The machine name must only contain lowercase letters, numbers, dashes and underscores.',
        ];
    }
}
