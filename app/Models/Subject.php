<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * App\Models\Subject
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Subject newModelQuery()
 * @method static Builder|Subject newQuery()
 * @method static Builder|Subject query()
 * @method static Builder|Subject whereCreatedAt($value)
 * @method static Builder|Subject whereDeletedAt($value)
 * @method static Builder|Subject whereDescription($value)
 * @method static Builder|Subject whereId($value)
 * @method static Builder|Subject whereName($value)
 * @method static Builder|Subject whereUpdatedAt($value)
 * @mixin Eloquent
 * @method static \Illuminate\Database\Query\Builder|Subject onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Subject withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Subject withoutTrashed()
 * @property-read Collection|User[] $users
 * @property-read int|null $users_count
 * @property-read Collection|\App\Models\Session[] $sessions
 * @property-read int|null $sessions_count
 */
class Subject extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * many to many user, subject relationship
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {

        return $this->belongsToMany(User::class, 'user_subject');
    }

    /**
     * Sessions
     * @return HasMany
     */
    public function sessions(): HasMany
    {
        return $this->hasMany(Session::class);
    }
}

