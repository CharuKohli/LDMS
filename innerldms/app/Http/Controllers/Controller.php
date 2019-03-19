<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function dateConvert($incomingdate){
      if($incomingdate!=null){
        $outgoingdate=date('Y-m-d',strtotime($incomingdate));
      }else{
        $outgoingdate=null;
      }
      return $outgoingdate;

    }
}
