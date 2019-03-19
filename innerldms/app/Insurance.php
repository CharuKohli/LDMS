<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
  protected $table="tbl_insurance_master";
  protected  $fillable=['name','company','date','amt_paid','exp_date','no_of_renewals','contact_person','contact_number','alertdays'];

  public function insCertificates(){
           return $this->hasMany(InsuranceImage::class);
       }

}
