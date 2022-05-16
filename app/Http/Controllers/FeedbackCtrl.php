<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Feedback;

class FeedbackCtrl extends Controller
{
    public function index(Request $req)
    {
        $data = $req->all();
        $user = Session::get('auth');
        $name = $user->fname." ".$user->mname." ".$user->lname;
        if($req->isMethod('get')) {
            if($req->id)
            {
                $data = Feedback::find($req->id);
            }
            else{
                $data = array();
            }
            return view('feedback',[
                'name' => $name,
                'data' => $data
                
            ]);
        }
        if($req->isMethod('post')){
            $match = array('id' => $req->id);

            $form = Feedback::UpdateOrCreate($match,$data);

            if($form->wasRecentlyCreated)
            {
             Session::put("feedback_add",true);
             }
             else
             {
             Session::put("feecback_update",true);
             }
            return Redirect::back();
            
        }
    }

    public function view(Request $req)
    {
    $user_id = Session::get('auth')->id;
    $keyword = $req->keyword;

    $data = Feedback::where('void',1)
    ->where('user_id',$user_id)
    ->where(function($q) use ($keyword){
        $q->where('subject',"like","%$keyword%")
          ->orwhere('message',"like","%$keyword%");
          })
    ->paginate(10);


    return view('feedbackview',[
        'data' => $data
    ]);
    }

    public function sindex(Request $req)
    {
        $keyword = $req->keyword;
        $data = Feedback::where('void',1)
        ->where(function($q) use ($keyword){
            $q->where('subject',"like","%$keyword%")
              ->orwhere('message',"like","%$keyword%");
              })
            ->paginate(15);

        return view('superadmin.sfeedback',[
            'data' => $data
        ]);
    }
    
    public function sindexBody(Request $req)
    {
        if($req->id)
        {
          $data = Feedback::select('feedback.*','users.fname','users.mname')
                        ->leftjoin('users','feedback.user_id','=','users.id')
                        ->where('feedback.id',$req->id)
                        ->first();
        }
        else{
            $data = array();
        }

        return response()->json($data);
    }

    public function sfeedbackResponse(Request $req)
    {
        Feedback::find($req->id)->update([
            'remarks' => $req->remarks,
            'action' => 'notified'
        ]);

        Session::put('feedback_response',true);

        return redirect::back();
    }
}