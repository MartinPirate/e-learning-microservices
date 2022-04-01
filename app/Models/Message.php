<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Message
 *
 * @property int $id
 * @property string|null $heading
 * @property int $sender_id
 * @property int $recipient_id
 * @property string $body
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Message newModelQuery()
 * @method static Builder|Message newQuery()
 * @method static Builder|Message query()
 * @method static Builder|Message whereBody($value)
 * @method static Builder|Message whereCreatedAt($value)
 * @method static Builder|Message whereDeletedAt($value)
 * @method static Builder|Message whereHeading($value)
 * @method static Builder|Message whereId($value)
 * @method static Builder|Message whereRecipientId($value)
 * @method static Builder|Message whereSenderId($value)
 * @method static Builder|Message whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|Message onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Message withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Message withoutTrashed()
 */
class Message extends Model
{
    use HasFactory, SoftDeletes;
}
