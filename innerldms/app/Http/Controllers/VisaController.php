<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ForeignNational;

class VisaController extends Controller
{
  public function saveForeignDocuments(Request $request){
    $records=new ForeignNational;
    $exp_date=date('Y-m-d',strtotime($request->visa_exp_date));
    $userid=session('userid');
    $records->user_id=$userid;
    $records->name=$request->name;
    $records->country=$request->country;
    $records->passport_num=$request->passport_num;
    $records->visa_num=$request->visa_num;
    $records->visa_exp_date=$exp_date;
    $records->embassy_addr=$request->embassy_addr;
    $records->alertdays=$request->alertdays;
    $records->save();
    $message="Data saved successfully";
    return response()->json(['msg'=>$message]);
  }

  public function dispForeignDocuments(){
     $html=$this->VisaRecords();
    return response()->json(['html'=>$html]);
  }

  public function visaNotification(){
    $records=ForeignNational::where('user_id',session('userid'))->get(['visa_exp_date','name','alertdays']);

         $expdates=array();
         $names=array();
         if(count($records)>0){
           $today=strtotime(date("Y-m-d"));
          $mydate=getdate(date("U"));
           $myMonth="$mydate[month]";
          $myDay="$mydate[mday]";
           $duetime_sec="";

        foreach($records as $row){
        $due=$row->visa_exp_date;
        $alertdays=$row->alertdays;
        if($due!=''){
        for($i=$alertdays;$i>=0;$i--)
         {
               $duetime=strtotime(date("Y-m-d",strtotime("$due -$i days")));
                if($today==$duetime)
                 {

                    if($duetime_sec!= $duetime){
                         array_push($expdates,$row->visa_exp_date);
                         array_push($names,$row->name);
                          break;
                  }
                else{
                  $duetime_sec=$duetime;
                 }
           }
        }
      }
     }
  }
$html = view('partials.visanotification',compact('expdates','names'))->render();
return response()->json(['html'=>$html]);
}

public function VisaRecords(){
  $userid=session('userid');
  $records=ForeignNational::where('user_id',$userid)->get();
  $html = view('partials.dispForeignDocs',compact('records'))->render();
  return $html;
}

public function deleteVisa($id){
  ForeignNational::where('id',$id)->where('user_id',session('userid'))->delete();
  $html=$this->VisaRecords();
  return response()->json(['html'=>$html]);
}
public function editVisa($id){
  $records=ForeignNational::where('id',$id)->where('user_id',session('userid'))->get();
  return response()->json(['record'=>$records]);
}

public function updateForeignDocument(Request $request){
       $visa_exp_date=$this->dateConvert($request->input('visa_exp_date'));
       $id=$request->input('id');
       $data=$request->except('_token');
       $data['visa_exp_date']=$visa_exp_date;
       ForeignNational::where('id',$id)->where('user_id',session('userid'))->update($data);
       $message="data Updated successfully";
       return response()->json(['msg'=>$message]);
}


}
