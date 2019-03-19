<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Director;

class DirectorController extends Controller
{

  public function saveDirector(Request $request){
   $director=new Director;

  $exp_date=date('Y-m-d',strtotime($request->exp_date));
  $userid=session('userid');
  $director->user_id=$userid;
  $director->name=$request->input('name');
  $director->digi_sign_num=$request->input('digi_sign_num');
  $director->exp_date=$exp_date;
  $director->alertdays=$request->input('alertdays');
  $director->save();
  $message="Data saved successfully";
  return response()->json(['msg'=>$message]);
}


public function dispDirector(){
$html=$this->DirectorRecords();
return response()->json(['html'=>$html]);
}

public function DirectorRecords(){
  $userid=session('userid');
  $records=Director::where('user_id',$userid)->get();
  $html = view('partials.dispDirector',compact('records'))->render();
  return $html;
}
public function deleteDirector($id){
  $userid=session('userid');
Director::where('id',$id)->where('user_id',$userid)->delete();
$html=$this->DirectorRecords();
return response()->json(['html'=>$html]);
}

public function editDirector($id){
$records=Director::where('id',$id)->where('user_id',session('userid'))->get();
return response()->json(['record'=>$records]);
}

public function updateDirector(Request $request){
       $exp_date=$this->dateConvert($request->input('exp_date'));
       $id=$request->input('id');
       $data=$request->except('_token');
       $data['exp_date']=$exp_date;
       Director::where('id',$id)->where('user_id',session('userid'))->update($data);
       $message="data Updated successfully";
       return response()->json(['msg'=>$message]);
}

public function directorNotification(){

  $records=Director::where('user_id',session('userid'))->get(['name','exp_date','alertdays']);

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
$html = view('partials.directornotification',compact('expdates','names'))->render();
return response()->json(['html'=>$html]);

}




}
