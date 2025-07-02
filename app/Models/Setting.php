<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $fillable =['site_title', 'email', 'email_2','landline','landline_2','mobile_no', 'mobile_no_2', 'fax','address','post_code', 'logo', 'favicon','google_analytics','google_map','meta_title','meta_keywords','meta_description', 'created_at', 'updated_at',];

}
