<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;

/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $phone_number
 * @property string $date_of_birth
 * @property int $agreed_to_terms
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User orWherePermissionIs($permission = '')
 * @method static Builder|User orWhereRoleIs($role = '', $team = null)
 * @method static Builder|User query()
 * @method static Builder|User whereAgreedToTerms($value)
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDateOfBirth($value)
 * @method static Builder|User whereDoesntHavePermission()
 * @method static Builder|User whereDoesntHaveRole()
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereLastName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePermissionIs($permission = '', $boolean = 'and')
 * @method static Builder|User wherePhoneNumber($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRoleIs($role = '', $team = null, $boolean = 'and')
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $address
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Wallet|null $wallet
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static Builder|User whereAddress($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @method static create(array $data)
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read int|null $clients_count
 * @property string|null $photo
 * @method static Builder|User wherePhoto($value)
 * @property int|null $grade_id
 * @property string|null $timezone
 * @property int|null $country_id
 * @property float|null $hour_rate
 * @property-read string|null $gravatar
 * @property-read string $name
 * @method static Builder|User whereCountryId($value)
 * @method static Builder|User whereGradeId($value)
 * @method static Builder|User whereHourRate($value)
 * @method static Builder|User whereTimezone($value)
 * @property int|null $state_id
 * @property int|null $city_id
 * @property-read \App\Models\City|null $city
 * @property-read \App\Models\Country|null $country
 * @property-read \App\Models\State|null $state
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $subjects
 * @property-read int|null $subjects_count
 * @method static Builder|User admins()
 * @method static Builder|User essayWriters()
 * @method static Builder|User gitfManagers()
 * @method static Builder|User organizations()
 * @method static Builder|User students()
 * @method static Builder|User teachers()
 * @method static Builder|User whereCityId($value)
 * @method static Builder|User whereStateId($value)
 * @property-read \App\Models\Grade|null $grade
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Session[] $sessions
 * @property-read int|null $sessions_count
 * @method static Builder|User counsellors()
 * @method static Builder|User giftManagers()
 * @method static Builder|User prospectiveStudents()
 */
class User extends Authenticatable
{
    use LaratrustUserTrait;
    use \Laravel\Passport\HasApiTokens, HasFactory, Notifiable;
    use softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'agreed_to_terms',
        'date_of_birth',
        'address',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
/*        'date_of_birth' => 'date',*/
    ];

    /**
     * @return HasOne
     * user wallet relationship
     */
    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    /**
     * Full Name attribute
     * @return string
     */
    public function getNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    /**
     * @return string|null
     */
    public function getGravatarAttribute(): ?string
    {
        if (@$this->photo) {
            return $this->photo;
        }

        return get_gravatar($this->email);
    }

    /**
     * many to many user, subject relationship
     * @return BelongsToMany
     */
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'user_subject');
    }

    /**
     * Student Grade
     * @return HasOne
     */
    public function grade(): HasOne
    {
        return $this->hasOne(Grade::class);
    }


    /**
     * User Country
     * @return BelongsTo
     */
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * User City
     * @return BelongsTo
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    /**
     * User City
     * @return BelongsTo
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Get a list of all students
     * @return mixed
     */
    public function scopeStudents()
    {

        return self::whereHas('roles', static function ($query) {
            $query->whereName('student');
        });

    }

    /**
     * Get a list of all admins
     * @return mixed
     */
    public function scopeAdmins()
    {

        return self::whereHas('roles', static function ($query) {
            $query->whereName('administrator');
        });

    }

    /**
     * Get a list of teachers
     * @return mixed
     */
    public function scopeTeachers()
    {

        return self::whereHas('roles', static function ($query) {
            $query->whereName('teacher');
        });

    }

    /**
     * Get a list of git managers
     * @return mixed
     */
    public function scopeGiftManagers()
    {
        return self::whereHas('roles', static function ($query) {
            $query->whereName('teacher');
        });

    }

    /**
     * Get a list of Organizations
     * @return mixed
     */
    public function scopeOrganizations()
    {

        return self::whereHas('roles', static function ($query) {
            $query->whereName('school');
        });

    }

    /**
     * Get a list of Essay Writers
     * @return mixed
     */
    public function scopeEssayWriters()
    {

        return self::whereHas('roles', static function ($query) {
            $query->whereName('essay_writer');
        });

    }

    /**
     * Get a list of counsellors
     * @return mixed
     */
    public function scopeCounsellors()
    {

        return self::whereHas('roles', static function ($query) {
            $query->whereName('counselors');
        });

    }

    /**
     * Get a list of prospective students
     * @return mixed
     */
    public function scopeProspectiveStudents()
    {

        return self::whereHas('roles', static function ($query) {
            $query->whereName('prospective_student');
        });

    }

    /**
     * User Sessions
     * @return BelongsToMany
     */
    public function sessions(): BelongsToMany
    {
        return $this->belongsToMany(Session::class, 'session_student', 'student_id', 'id');
    }


}
