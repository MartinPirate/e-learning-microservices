<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property float $amount
 * @property string $currency
 * @property string $type
 * @property int|null $paid_to
 * @property string $status
 * @property string|null $details
 * @property string|null $reference
 * @property string $gateway
 * @property int $paid_by
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Transaction newModelQuery()
 * @method static Builder|Transaction newQuery()
 * @method static Builder|Transaction query()
 * @method static Builder|Transaction whereAmount($value)
 * @method static Builder|Transaction whereCreatedAt($value)
 * @method static Builder|Transaction whereCurrency($value)
 * @method static Builder|Transaction whereDeletedAt($value)
 * @method static Builder|Transaction whereDetails($value)
 * @method static Builder|Transaction whereGateway($value)
 * @method static Builder|Transaction whereId($value)
 * @method static Builder|Transaction wherePaidBy($value)
 * @method static Builder|Transaction wherePaidTo($value)
 * @method static Builder|Transaction whereReference($value)
 * @method static Builder|Transaction whereStatus($value)
 * @method static Builder|Transaction whereType($value)
 * @method static Builder|Transaction whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Transaction extends Model
{
    use HasFactory;
}
