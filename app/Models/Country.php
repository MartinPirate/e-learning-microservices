<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $name
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Country newModelQuery()
 * @method static Builder|Country newQuery()
 * @method static Builder|Country query()
 * @method static Builder|Country whereCreatedAt($value)
 * @method static Builder|Country whereDeletedAt($value)
 * @method static Builder|Country whereId($value)
 * @method static Builder|Country whereName($value)
 * @method static Builder|Country whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|Country onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Country withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Country withoutTrashed()
 * @property string|null $slug
 * @property string|null $country_iso_code
 * @property string|null $country_name
 * @property string|null $country_code
 * @property string|null $country_order
 * @property int|null $status
 * @property int|null $is_default
 * @property int|null $show_home
 * @property-read \App\Models\User|null $user
 * @method static Builder|Country whereCountryCode($value)
 * @method static Builder|Country whereCountryIsoCode($value)
 * @method static Builder|Country whereCountryName($value)
 * @method static Builder|Country whereCountryOrder($value)
 * @method static Builder|Country whereIsDefault($value)
 * @method static Builder|Country whereShowHome($value)
 * @method static Builder|Country whereSlug($value)
 * @method static Builder|Country whereStatus($value)
 */
class Country extends Model
{
    use HasFactory, SoftDeletes;

    /**
     *  User Country
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
