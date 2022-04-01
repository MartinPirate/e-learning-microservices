<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laratrust\Models\LaratrustRole;

/**
 * App\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static Builder|Role newModelQuery()
 * @method static Builder|Role newQuery()
 * @method static Builder|Role query()
 * @method static Builder|Role whereCreatedAt($value)
 * @method static Builder|Role whereDescription($value)
 * @method static Builder|Role whereDisplayName($value)
 * @method static Builder|Role whereId($value)
 * @method static Builder|Role whereName($value)
 * @method static Builder|Role whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $deleted_at
 * @method static Builder|Role whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Role onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Role withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Role withoutTrashed()
 */

class Role extends LaratrustRole
{

    use SoftDeletes;

    public const TEACHER = 'teacher';
    public const STUDENT = 'student';
    public const ORGANIZATION = 'school';
    public const ADMIN = 'administrator';
    public const SUPER_ADMIN = 'super_administrator';
    public const PARENT = 'parent';
    public const AWARD_MANAGER = 'award_manager';
    public  const PROSPECTIVE_STUDENT = 'prospective_student';
    public const PROSPECTIVE_PARENT = 'prospective_parent';
    public const COUNSELOR = 'counselors';
    public $guarded = [];
}
