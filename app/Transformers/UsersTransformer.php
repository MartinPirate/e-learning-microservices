<?php

namespace App\Transformers;

use App\Models\User;
use Carbon\Carbon;
use League\Fractal\TransformerAbstract;

class UsersTransformer extends TransformerAbstract
{
    public function transform(User $user): array
    {
        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'photo' => $user->gravatar,
            'phone' => $user->phone_number,
            'address' => $user->address,
            'created_date' => Carbon::parse($user->created_at)->format('d-m-Y'),
        ];
    }
}
