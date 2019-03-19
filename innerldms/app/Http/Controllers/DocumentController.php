<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Document;
use App\DocImage;
class DocumentController extends Controller
{
    public function saveDocuments(Request $request){
     $doc=new Document;
     $regname=$request->input('regname');
     $pathfordb=null;
     $imagedate=date("d-m-Y_H-i-s");
     $filename=null;

    $reg_date=date('Y-m-d',strtotime($request->date));
    $renewal_date=date('Y-m-d',strtotime($request->renewaldate));
    $userid=session('userid');
    $doc->user_id=$userid;
    $doc->doc_name=$regname;
    $doc->purpose=$request->input('purpose');
    $doc->reg_date=$reg_date;
    $doc->renewal_date=$renewal_date;
    $doc->count_doc_renewed=$request->input('number');
    $doc->amount=$request->input('amount');
  //  $doc->doc_img_path=$pathfordb;
    $doc->doc_shared_to=$request->input('sharedwith');
      $doc->alertdays=$request->input('alertdays');
    $doc->save();

    if($request->hasFile('file')){
    $lastdocid=Document::max('id');
    $dir = 'assets/Documents/';
    $i=0;
    foreach($request->file('file') as $file){
        $extension = $file->getClientOriginalExtension();
        //$original_filename = $file->getClientOriginalName();
        $filename = $regname.'_'.$imagedate.'_'.($i+1).'.'.$extension;
        $file->move($dir, $filename);
        $pathfordb=$dir.$filename;
        $i++;

        $docimage=new DocImage;
        $docimage->document_id=$lastdocid;
        $docimage->doc_img_path=$pathfordb;
        $docimage->save();

      }
    }

    $message="Data saved successfully";
    return response()->json(['msg'=>$message]);
    }

    public function dispDocuments(){
      $html=$this->DocRecords();
    return response()->json(['html'=>$html]);
    }

public function DocRecords(){
  $userid=session('userid');
  $docs=Document::where('user_id',$userid)->get();
  $html = view('partials.dispDocs',compact('docs'))->render();
  return $html;
}



public function docNotification(){

  $records=Document::where('user_id',session('userid'))->get(['doc_name','renewal_date','alertdays']);

       $renewaldates=array();
       $docnames=array();
       if(count($records)>0){
         $today=strtotime(date("Y-m-d"));
        $mydate=getdate(date("U"));
         $myMonth="$mydate[month]";
        $myDay="$mydate[mday]";
         $renewaltime_sec="";

      foreach($records as $row){
      $due=$row->renewal_date;
      $alertdays=$row->alertdays;
      if($due!=''){
      for($i=$alertdays;$i>=0;$i--)
       {
             $renewaltime=strtotime(date("Y-m-d",strtotime("$due -$i days")));
              if($today==$renewaltime)
               {

                  if($renewaltime_sec!= $renewaltime){
                       array_push($renewaldates,$row->renewal_date);
                       array_push($docnames,$row->doc_name);
                        break;
                }
              else{
                $renewaltime_sec=$renewaltime;
               }
         }
      }
    }
   }
}
$html = view('partials.docnotification',compact('renewaldates','docnames'))->render();
return response()->json(['html'=>$html]);

}

public function DeleteDoc($id){

  $datas=DocImage::where('document_id',$id)->where('user_id',session('userid'))->get();
  foreach($datas as $data){
    $imagepath=$data->doc_img_path;
    if (file_exists($imagepath))
    {
    unlink($imagepath);
    }
  }
Document::find($id)->delete();
$html=$this->DocRecords();
return response()->json(['html'=>$html]);
}

public function EditDoc($id){
$records=Document::where('id',$id)->where('user_id',session('userid'))->get();
return response()->json(['docrecord'=>$records]);
}

public function updateDoc(Request $request){
       $date=$this->dateConvert($request->input('date'));
       $renewaldate=$this->dateConvert($request->input('renewaldate'));
       $id=$request->input('id');
       //$data=$request->except('_token');
      // var_dump($data);
       $data['doc_name']=$request->input('regname');
       $data['purpose']=$request->input('purpose');
       $data['reg_date']=$date;
       $data['renewal_date']=$renewaldate;
       $data['count_doc_renewed']=$request->input('number');
       $data['amount']=$request->input('amount');
       $data['doc_shared_to']=$request->input('sharedwith');
       $data['alertdays']=$request->input('alertdays');
       Document::where('id',$id)->where('user_id',session('userid'))->update($data);
       $message="data Updated successfully";
       return response()->json(['msg'=>$message]);
}


public function showDocuments($id){
  $datas=Document::where('id',$id)->where('user_id',session('userid'))->get();
  $doc_name=null;
  $docimgpath=array();
  $docid=array();
  foreach($datas as $data){

    $docimagepath=$data->docImages;
    $doc_name=$data->doc_name;
    //echo $billpath;
    foreach($docimagepath as $path){
      array_push($docimgpath,$path->doc_img_path);
      array_push($docid,$path->id);
    }
  }
    $html = view('partials.dispDocImages',compact('docimgpath','id','doc_name','docid'))->render();
    return response()->json(['html'=>$html]);
}

public function uploadDocumentImage(Request $request){
  $pathfordb=null;
  $imagedate=date("d-m-Y_H-i-s");
  $filename=null;
  $id=$request->id;
  $docname=$request->docname;
  if($request->hasFile('file')){
  $dir = 'assets/Documents/';
  $i=0;
  foreach($request->file('file') as $file){
      $extension = $file->getClientOriginalExtension();
      //$original_filename = $file->getClientOriginalName();
      $filename = $docname.'_'.$imagedate.'_'.($i+1).'.'.$extension;
      $file->move($dir, $filename);
      $pathfordb=$dir.$filename;
      $i++;

      $docimage=new DocImage;
      $docimage->document_id=$id;
      $docimage->doc_img_path=$pathfordb;
      $docimage->save();

    }
  }
$msg="Document uploaded successfully";
 return response()->json(['msg'=>$msg]);
}

public function deleteSelectedDocImage($imgid){
      $datas=DocImage::find($imgid)->get();
      foreach($datas as $data){
        $imagepath=$data->doc_img_path;
      }
      $filename = $imagepath;
      $target_file=$filename;
      if (file_exists($target_file))
      {
      unlink($target_file);
      }

      DocImage::find($imgid)->delete();
      return;
    }

}
