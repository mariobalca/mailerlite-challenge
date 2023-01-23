<?php

namespace App\Http\Requests;

use App\Rules\FieldExists;
use Illuminate\Foundation\Http\FormRequest;

class SubscriberRequest extends FormRequest
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
            'email' => 'required|email|unique:subscribers,email' . $this->subscriber,
            'name' => 'required|max:255',
            'state' => 'in:active,unsubscribed,junk,bounced,unconfirmed',
            'fields.*' => [new FieldExists]
        ];
    }
}
