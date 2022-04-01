<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\Resource\Item;
use League\Fractal\TransformerAbstract;

class TeacherTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'wallet'
    ];


    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user): array
    {
        return [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'phone' => $user->phone_number,
            'address' => $user->address,
            'phone_number' => $user->phone_number,
            'hourly_rate' => $user->hour_rate,
            'country' => $user->country,
            'city' => $user->city,
            'state' => $user->state,
            'subjects' => $user->subjects,
        ];
    }


    /**
     * @param User $user
     * @return Item
     */
    public function includeWallet(User $user): Item
    {

        return $this->item($user->wallet, new WalletTransformer(), 'wallet');
    }
}
