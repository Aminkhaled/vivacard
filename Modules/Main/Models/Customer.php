<?php

namespace Modules\Main\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, Notifiable;

     /**
     * database connection.
     *
     * @var string
     */
    protected $connection = 'mysql';

    /**
     * Table name.
     *
     * @var string
     */
    protected $table = 'customers';
    // protected $guard = 'customer';

    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'customers_id';

    /**
     * Timestamps.
     *
     * @var string
     */
    const CREATED_AT = 'customers_created_at';
    const UPDATED_AT = 'customers_updated_at';

    /**
     * Fillable fields.
     *
     * @var array
     */
    protected $fillable = [
        'customers_name', 'customers_email', 'password','customers_country_code', 'customers_phone','customers_birthdate','customers_gender', 'customers_image','customers_status', 'email_verified', 'phone_verified', 'device_token', 'email_verification_code','countries_id','cities_id',
    ];

    /**
     * Set customers's image.
     *
     * @param string $file
     */
    public function setCustomersImageAttribute($file)
    {
        if ($file) {
            if (is_string($file)) {
                $this->attributes['customers_image'] = $file;
            } else {
                $current_name = $file->getClientOriginalName();

                $this->originalImage($file, $current_name ,'customers');
                $this->mediumImage($file, $current_name ,null,400,'customers');
                $this->thumbImage($file, $current_name ,null,100,'customers');

                $this->attributes['customers_image'] = $current_name;
            }
        } else {
            $this->attributes['customers_image'] = null;
        }
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email_verification_code', 'device_token'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
    }

    /**
     * Specifies the user's FCM token
     *
     * @return string
     */
    public function routeNotificationForFcm()
    {
        return $this->device_token;
    }

    /**
     * Set password encryption.
     *
     * @param string $value
     */
    public function setPasswordAttribute($value)
    {
        if ($value) {
            $password = bcrypt($value);
            $this->attributes['password'] = $password;
        }
    }

    /**
     * Scope a query to order data.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type    ['asc', 'desc']
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSorted($query, $type='asc')
    {
        return $query->orderBy('customers.customers_id', $type);
    }

    /**
     * Scope a query to order data.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $type    ['asc', 'desc']
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('customers.customers_status', '1');
    }

    /**
     * Many to one relation with countries.
     *
     * @return collection of modules
     */
    public function country()
    {
        return $this->belongsTo('Modules\Main\Models\Country', 'countries_id', 'countries_id');
    }

    /**
     * Many to one relation with cities.
     *
     * @return collection of modules
     */
    public function city()
    {
        return $this->belongsTo('Modules\Main\Models\City', 'cities_id', 'cities_id');
    }


}
