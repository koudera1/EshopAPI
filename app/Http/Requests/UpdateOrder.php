<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrder extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'firstname' => 'regex:/^[\s\-\p{L}]*$/u',
            'lastname' => 'regex:/^[\s\-\p{L}]*$/u',
            'email' => 'email',
            'telephone' => 'regex:/^\+?[\d\s]{9,15}$/',
            'shipping_firstname' => 'regex:/^[\s\-\p{L}]*$/u',
            'shipping_lastname' => 'regex:/^[\s\-\p{L}]*$/u',
            'shipping_address_1' => 'regex:/^[\\0-9\s\-\p{L}]*$/u',
            'shipping_address_2' => 'regex:/^[\\0-9\s\-\p{L}]*$/u',
            'shipping_city' => 'regex:/^[\s\-\p{L}]*$/u',
            'shipping_postcode' => 'regex:/^[\s0-9]*$/',
            //'shipping_zone_id' => 'numeric',
            'shipping_country' => 'regex:/^[\s\-\p{L}]*$/u',
            //'shipping_country_id' => 'numeric',
            'payment_firstname' => 'regex:/^[\s\-\p{L}]*$/u',
            'payment_lastname' => 'regex:/^[\s\-\p{L}]*$/u',
            'payment_address_1' => 'regex:/^[\\0-9\s\-\p{L}]*$/u',
            'payment_address_2' => 'regex:/^[\\0-9\s\-\p{L}]*$/u',
            'payment_city' => 'regex:/^[\s\-\p{L}]*$/u',
            'payment_postcode' => 'regex:/^[\s0-9]*$/',
            //'payment_zone_id' => 'numeric',
            'payment_country' => 'regex:/^[\s\-\p{L}]*$/u',
            //'payment_country_id' => 'numeric',
            'password' => $this->passwordRules(),
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'firstname.regex' => 'Neplatné jméno.',
            'lastname.regex' => 'Neplatné příjmení.',
            'email.email' => 'Neplatná emailová adresa.',
            'telephone.regex' => 'Neplatné telefonní číslo.',
            'shipping_firstname.regex' => 'Neplatné doručovací jméno.',
            'shipping_lastname.regex' => 'Neplatné doručovací příjmení.',
            'shipping_address_1.regex' => 'Neplatná doručovací adresa.',
            'shipping_address_2.regex' => 'Neplatná doručovací adresa.',
            'shipping_city.regex' => 'Neplatné doručovací město.',
            'shipping_postcode.regex' => 'Neplatné doručovací poštovní směrovací číslo.',
            'shipping_country.regex' => 'Neplatný doručovací stát.',
            'payment_firstname.regex' => 'Neplatné fakturační jméno.',
            'payment_lastname.regex' => 'Neplatné fakturační příjmení.',
            'payment_address_1.regex' => 'Neplatná fakturační adresa.',
            'payment_address_2.regex' => 'Neplatná fakturační adresa.',
            'payment_city.regex' => 'Neplatné fakturační město.',
            'payment_postcode.regex' => 'Neplatné fakturační poštovní směrovací číslo.',
            'payment_country.regex' => 'Neplatný fakturační stát.',
        ];
    }
}
