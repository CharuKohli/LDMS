<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Document extends Model
{
  protected $table="tbl_documents";
  protected  $fillable=['doc_name','purpose','reg_date','renewal_date','count_doc_renewed','amount','doc_shared_to','alertdays'];

  public function docImages(){
           return $this->hasMany(DocImage::class);
       }

}
