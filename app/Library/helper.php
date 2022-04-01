<?php

use App\Models\Role;
use App\Models\Subject;
use App\Models\User;
use App\Models\Wallet;
use App\Transformers\UserTransformer;
use League\Fractal\Serializer\ArraySerializer;


/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param int $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param bool $img True to return a complete IMG tag False for just the URL
 * @param array $attributes Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source https://gravatar.com/site/implement/images/php/
 */
function get_gravatar($email, $s = 80, $d = 'mm', $r = 'g', $img = false, $attributes = []): string
{
    $url = 'https://www.gravatar.com/avatar/';
    $url .= md5(strtolower(trim($email)));
    $url .= "?s=$s&d=$d&r=$r";
    if ($img) {
        $url = '<img src="' . $url . '"';
        foreach ($attributes as $key => $val) {
            $url .= ' ' . $key . '="' . $val . '"';
        }
        $url .= ' />';
    }
    return $url;
}

if (!function_exists('generate_account_no')) {
    /**Generate user account no
     * @return int
     * @throws Exception
     */
    function generate_account_no(): int
    {
        $number = mt_rand(1000000, 9999999);
        if (account_exist($number)) {
            return generate_account_no();
        }
        return $number;
    }
}

if (!function_exists('account_exist')) {
    /**
     * Check if the account Number exist
     * @param int $number
     * @return bool
     */
    function account_exist(int $number): bool
    {
        return Wallet::whereAccountNo($number)->exists();

    }
}

if (!function_exists('transformObjects')) {
    /**
     * @param $user
     * @return \Spatie\Fractal\Fractal
     */
    function transformUser($user): \Spatie\Fractal\Fractal
    {

        $includes = ['roles'];
        if ($user->hasRole('teacher')) {
            $includes = ['roles', 'wallet'];
        }

        return fractal()->item($user, new UserTransformer())
            ->serializeWith(new ArraySerializer())
            ->parseIncludes($includes);
    }
}

if (!function_exists('additionalRules')) {

    /**
     *Additional Rules based on the selected Role
     * @param $role
     * @return array
     */
    function additionalRules($role): array
    {

        // Standard rules
        $rules = [];

        if ($role === Role::TEACHER) {

            $rules['address'] = 'required';
            $rules['country_id'] = ['required ', 'exists:countries,id'];
            $rules['state_id'] = ['required ', 'exists:states,id'];
            $rules['city_id'] = ['required ', 'exists:cities,id'];
            $rules['hour_rate'] = 'required';

        }
        if ($role === Role::STUDENT) {

            $rules['grade'] = ['required ', 'exists:grades,id'];
        }


        return $rules;
    }


}

if (!function_exists('additionalRulesMessages')) {
    /**
     * Additional Rules messages
     * @return string[]
     */
    function additionalRulesMessages(): array
    {
        return [
            'phone.required' => 'The Phone field is required',
            'address.required' => 'The Address field is required',
            'date_of_birth.required' => 'The Date of Birth field is required',
            'country.required' => 'The Country field is required',
            'city.required' => 'The City field is required',
            'state.required' => 'The State field is required',
            'grade.required' => 'The Grade field is required',
            'hour_rate.required' => 'The Hour Rate field is required',

        ];
    }
}

if (!function_exists('handleManyToManySubjectsRelationship')) {
    function handleManyToManySubjectsRelationship(User $user, $subject_name)
    {
        //Todo Implement an array of Subjects

        $subject = handleSaveSubject($subject_name);

        $user->subjects()->attach($subject);


    }
}


if (!function_exists('handleSaveSubject')) {

    /**
     * Save the subject
     * @param $subject_name
     * @return Subject
     */
    function handleSaveSubject($subject_name): Subject
    {

        $subject = new Subject();
        $subject->name = $subject_name;
        $subject->description = "This is " . $subject_name;
        $subject->save();

        return $subject;
    }

}


