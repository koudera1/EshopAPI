<?php

namespace App\Actions\Fortify;

use App\Http\Requests\UpdateOrder;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\Customer
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'password' => $this->passwordRules(),
        ])->validate();

        $request = new UpdateOrder($input);
        $request->validated();

        return Customer::create([
            'firstname' => $input['name'],
            'lastname' => $input['lastname'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'date_added' => date("Y-m-d H:i:s")
        ]);
    }
}
