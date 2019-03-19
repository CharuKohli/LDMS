<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForeignNational extends Model
{
  protected $table="tbl_foriegnnationals";
  protected  $fillable=['name','country',	'passport_num',	'visa_num',	'visa_exp_date','alertdays'];

}
