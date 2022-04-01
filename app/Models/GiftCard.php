<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\GiftCard
 *
 * @property int $id
 * @property string $name
 * @property float $amount
 * @property string $expiry_date
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|GiftCard newModelQuery()
 * @method static Builder|GiftCard newQuery()
 * @method static Builder|GiftCard query()
 * @method static Builder|GiftCard whereAmount($value)
 * @method static Builder|GiftCard whereCreatedAt($value)
 * @method static Builder|GiftCard whereDeletedAt($value)
 * @method static Builder|GiftCard whereExpiryDate($value)
 * @method static Builder|GiftCard whereId($value)
 * @method static Builder|GiftCard whereName($value)
 * @method static Builder|GiftCard whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|GiftCard onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|GiftCard withTrashed()
 * @method static \Illuminate\Database\Query\Builder|GiftCard withoutTrashed()
 */
class GiftCard extends Model
{
    use HasFactory, SoftDeletes;
}
