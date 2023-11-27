<?php

namespace Modules\General\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $connection = 'mysql';
    /**
     * Primary key.
     *
     * @var string
     */
    protected $primaryKey = 'settings_id';


    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'settings_key', 'settings_value'
    ];



}
