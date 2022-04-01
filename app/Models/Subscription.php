<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Subscription
 *
 * @property int $id
 * @property string $name
 * @property string $details
 * @property string $type
 * @property string $status
 * @property float $cost
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Subscription newModelQuery()
 * @method static Builder|Subscription newQuery()
 * @method static Builder|Subscription query()
 * @method static Builder|Subscription whereCost($value)
 * @method static Builder|Subscription whereCreatedAt($value)
 * @method static Builder|Subscription whereDeletedAt($value)
 * @method static Builder|Subscription whereDetails($value)
 * @method static Builder|Subscription whereId($value)
 * @method static Builder|Subscription whereName($value)
 * @method static Builder|Subscription whereStatus($value)
 * @method static Builder|Subscription whereType($value)
 * @method static Builder|Subscription whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|Subscription onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Subscription withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Subscription withoutTrashed()
 */
class Subscription extends Model
{
    use HasFactory, SoftDeletes;
}
