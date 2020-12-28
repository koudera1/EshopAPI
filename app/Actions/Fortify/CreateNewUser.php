<?php

namespace App\Actions\Fortify;

use App\Http\Requests\UpdateOrder;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     * @return Customer
     * @throws ValidationException
     */
    public function create(array $input)
    {
        $input['firstname'] = $input['name'];
        Validator::make($input,
            [
                'password' => $this->passwordRules(),
                'firstname' => 'regex:/^[\s\-\p{L}]*$/u',
                'email' => 'email'
            ],
            [
                'firstname' => "Neplatné jméno.",
                'email' => "Neplatný email."
            ]
        )->validate();

        return Customer::create([
            'firstname' => $input['name'],
            //'lastname' => $input['lastname'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
