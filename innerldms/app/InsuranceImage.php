<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InsuranceImage extends Model
{
  protected $table="tbl_insurance_images";
  protected  $fillable=['insurances_id','ins_certificate_path'];
  public function Insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
}
