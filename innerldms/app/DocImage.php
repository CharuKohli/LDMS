<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocImage extends Model
{
  protected $table="tbl_document_images";
  protected  $fillable=['document_id','doc_img_path'];

  public function Document()
    {
        return $this->belongsTo(Document::class);
    }
}
