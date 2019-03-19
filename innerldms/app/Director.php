<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Director extends Model
{
  protected $table="tbl_director_master";
  protected  $fillable=['name','digi_sign_num','exp_date','alertdays'];
}
