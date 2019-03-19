<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Insurance;
use App\InsuranceImage;
class InsuranceController extends Controller
{
  public function saveInsurance(Request $request){
   $insurance=new Insurance;
  $exp_date=date('Y-m-d',strtotime($request->exp_date));
  $date=date('Y-m-d',strtotime($request->date));
  $pathfordb=null;
  $imagedate=date("d-m-Y_H-i-s");
  $filename=null;
  $userid=session('userid');
  $insurance->user_id=$userid;
  $insurance_name=$request->input('name');
  $insurance->name=$insurance_name;
  $insurance->company=$request->input('company');
  $insurance->date=$date;
  $insurance->amt_paid=$request->input('amt_paid');
  $insurance->exp_date=$exp_date;
  $insurance->no_of_renewals=$request->input('no_of_renewals');
  $insurance->contact_person=$request->input('contact_person');
  $insurance->contact_number=$request->input('contact_number');
  $insurance->alertdays=$request->input('alertdays');
  $insurance->save();
  if($request->hasFile('file')){
  $lastinsid=Insurance::max('id');
  $dir = 'assets/Insurance_Certificates/';

      $extension = $request->file('file')->getClientOriginalExtension();
      $filename = $insurance_name.'_'.$imagedate.'.'.$extension;
      $request->file('file')->move($dir, $filename);
      $pathfordb=$dir.$filename;
      $insimage=new InsuranceImage;
      $insimage->insurance_id=$lastinsid;
      $insimage->ins_certificate_path=$pathfordb;
      $insimage->save();
  }

  $message="Data saved successfully";
  return response()->json(['msg'=>$message]);
}

public function dispInsurance(){
  $html=$this->InsuranceRecords();
  return response()->json(['html'=>$html]);
}

public function InsuranceRecords(){
  $userid=session('userid');
  $records=Insurance::where('user_id',$userid)->get();

  $html = view('partials.dispInsurances',compact('records'))->render();
  return $html;
}

public function deleteInsurance($id){
  $datas=InsuranceImage::where('insurance_id',$id)->where('user_id',session('userid'))->get();
  foreach($datas as $data){
    $imagepath=$data->ins_certificate_path;
    if (file_exists($imagepath))
    {
    unlink($imagepath);
    }
  }

  Insurance::where('id',$id)->where('user_id',session('userid'))->delete();
  $html=$this->InsuranceRecords();
  return response()->json(['html'=>$html]);
}

public function editInsurance($id){
$record=Insurance::where('id',$id)->where('user_id',session('userid'))->get();
return response()->json(['record'=>$record]);
}

public function updateInsurance(Request $request){
  $exp_date=$this->dateConvert($request->input('exp_date'));
  $date=$this->dateConvert($request->input('date'));
  $id=$request->input('id');
  $data=$request->except(['_token','file']);
  $data['date']=$date;
  $data['exp_date']=$exp_date;
  Insurance::where('id',$id)->where('user_id',session('userid'))->update($data);
  $message="data Updated successfully";
  return response()->json(['msg'=>$message]);
}

public function insuranceNotification(){

  $records=Insurance::where('user_id',session('userid'))->get(['name','exp_date','alertdays']);

       $expdates=array();
       $names=array();
       if(count($records)>0){
         $today=strtotime(date("Y-m-d"));
        $mydate=getdate(date("U"));
         $myMonth="$mydate[month]";
        $myDay="$mydate[mday]";
         $exptime_sec="";

      foreach($records as $row){
      $due=$row->exp_date;
      $alertdays=$row->alertdays;
      if($due!=''){
      for($i=$alertdays;$i>=0;$i--)
       {
             $exptime=strtotime(date("Y-m-d",strtotime("$due -$i days")));
              if($today==$exptime)
               {

                  if($exptime_sec!= $exptime){
                       array_push($expdates,$row->exp_date);
                       array_push($names,$row->name);
                        break;
                }
              else{
                $exptime_sec=$exptime;
               }
         }
      }
    }
   }
}
$html = view('partials.insuranceNotification',compact('expdates','names'))->render();
return response()->json(['html'=>$html]);

}

public function showInsCertificates($id){
  $datas=Insurance::where('id',$id)->where('user_id',session('userid'))->get();
  $doc_name=null;
  $docimgpath=array();
  $docid=array();
  foreach($datas as $data){

    $docimagepath=$data->insCertificates;
    $doc_name=$data->name;
    //echo $billpath;
    foreach($docimagepath as $path){
      array_push($docimgpath,$path->ins_certificate_path);
      array_push($docid,$path->id);
    }
  }
    $html = view('partials.dispInsCertificates',compact('docimgpath','id','doc_name','docid'))->render();
    return response()->json(['html'=>$html]);

}

public function uploadInsCertificate(Request $request){
  $pathfordb=null;
  $imagedate=date("d-m-Y_H-i-s");
  $filename=null;
  $id=$request->id;
  $docname=$request->docname;
  if($request->hasFile('file')){
  $dir = 'assets/Insurance_Certificates/';

      $extension = $request->file('file')->getClientOriginalExtension();
      //$original_filename = $file->getClientOriginalName();
      $filename = $docname.'_'.$imagedate.'.'.$extension;
      $request->file('file')->move($dir, $filename);
      $pathfordb=$dir.$filename;

      $docimage=new InsuranceImage;
      $docimage->insurance_id=$id;
      $docimage->ins_certificate_path=$pathfordb;
      $docimage->save();
  }
$msg="Insurance Certificate uploaded successfully";
 return response()->json(['msg'=>$msg]);
}

public function deleteInsCertificate($imgid){
      $datas=InsuranceImage::find($imgid)->get();
      foreach($datas as $data){
        $imagepath=$data->ins_certificate_path;
      }
      $filename = $imagepath;
      $target_file=$filename;
      if (file_exists($target_file))
      {
      unlink($target_file);
      }

      InsuranceImage::find($imgid)->delete();
      return;
    }



}
