<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signup extends Model
{
  protected $table="tbl_signup";
  protected  $fillable=['user_id',	'user_name'	,'password'];

}
