<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use App\Actions\Fortify\UpdateUserProfileInformation;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $validationRules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'address' => ['required'],
            'phone' => ['required'],
            'gender' => ['required'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];


        $Validationmessage = [
            'name.required' => "သင့်အမည် ထည့်သွင်းပေးပါ",
            'name.string' => "သင့်အမည် ထည့်သွင်းပေးပါ",
            'email.required' => "အီးမေးလိပ်စာ ထည့်သွင်းပေးပါ",
            'email.email' => "email format is invalid!",
            'email.string' => "email must be string!",
            'email.unique' => "this email already have!",
            'address.required' => "နေရပ်လိပ်စာ ထည့်သွင်းပေးပါ",
            'phone.required' => "ဖုန်းနံပါတ် ဖြည့်သွင်းပေးပါ",
            'gender.required' => "Please choose gender!"
        ];

        Validator::make($input,$validationRules,$Validationmessage)->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'address' => $input['address'],
            'phone' => $input['phone'],
            'gender' => $input['gender'],
            'image' => $input['image']
        ]);

        // return tap(User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'password' => Hash::make($input['password']),
        //     'address' => $input['address'],
        //     'phone' => $input['phone'],
        //     'gender' => $input['gender']
        // ]), function (User $user) use ($input) {
        //     $this->createTeam($user);
        
        //     if (isset($input['image'])) {
        //         $user->updateProfilePhoto($input['image']);
        //     }
        // });
    }
}
