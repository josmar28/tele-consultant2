<?php

namespace App\Http\Controllers\Tele;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Patient;
use App\Meeting;
use Carbon\Carbon;
use App\PendingMeeting;
use App\Facility;
use App\DocCategory;
use App\Countries;
use App\LabRequest;
use App\DoctorOrder;
use App\ZoomToken;
use App\DocOrderLabReq;
use Redirect;
use App\Doc_Type;
use App\MunicipalCity;
use App\Events\ReqTele;
use App\Events\AcDecReq;
class TeleController extends Controller
{
    public function __construct()
    {
        if(!$login = Session::get('auth')){
            $this->middleware('auth');
        }
    }

    public function index(Request $request) {
    	$user = Session::get('auth');
    	$keyword = $request->view_all ? '' : $request->date_range;
        $data = Meeting::select(
        	"meetings.*",
        	"meetings.id as meetID",
            "meetings.user_id as Creator",
            "meetings.doctor_id as RequestTo",
        	"pat.lname as patLname",
            "pat.fname as patFname",
            "pat.mname as patMname",
            "pat.id as PatID",
        )->leftJoin("patients as pat", "meetings.patient_id", "=", "pat.id");
        if($keyword){
        	$date_start = date('Y-m-d',strtotime(explode(' - ',$request->date_range)[0]));
            $date_end = date('Y-m-d',strtotime(explode(' - ',$request->date_range)[1]));
            $data = $data
                ->where(function($q) use($date_start, $date_end) {
                $q->whereBetween('meetings.date_meeting', [$date_start, $date_end]);
            });
        }
        $data = $data->where(function($q) use($user){
            $q->where("meetings.doctor_id","=", $user->id)
            ->orWhere("meetings.user_id", "=", $user->id);
            })->whereDate("meetings.date_meeting", ">=", Carbon::now()->toDateString())
        		->orderBy('meetings.date_meeting', 'asc')
        		->paginate(20);
    	$patients =  Patient::select(
            "patients.*",
            "user.email as email"
        ) ->leftJoin("users as user","patients.account_id","=","user.id")
         ->where('patients.facility_id',$user->facility_id)
        ->get();

        $keyword_past = $request->view_all_past ? '' : $request->date_range_past;
        $data_past = Meeting::select(
        	"meetings.*",
        	"meetings.id as meetID",
        	"pat.lname as patLname",
            "pat.fname as patFname",
            "pat.mname as patMname",
        )->leftJoin("patients as pat", "meetings.patient_id", "=", "pat.id");
        if($keyword_past){
        	$date_start = date('Y-m-d',strtotime(explode(' - ',$request->date_range_past)[0]));
            $date_end = date('Y-m-d',strtotime(explode(' - ',$request->date_range_past)[1]));
            $data_past = $data_past
                ->where(function($q) use($date_start, $date_end) {
                $q->whereBetween('meetings.date_meeting', [$date_start, $date_end]);
            });
        }
        $data_past = $data_past->where(function($q) use($user){
            $q->where("meetings.doctor_id","=", $user->id)
            ->orWhere("meetings.user_id", "=", $user->id);
            })->whereDate("meetings.date_meeting", "<", Carbon::now()->toDateString())
        		->orderBy('meetings.date_meeting', 'desc')
        		->paginate(20);

        $keyword_req = $request->view_all_req ? '' : $request->date_range_req;
        $data_req = PendingMeeting::select(
            "pending_meetings.*",
            "pending_meetings.id as meetID",
            "pending_meetings.created_at as reqDate",
            "pat.lname as patLname",
            "pat.fname as patFname",
            "pat.mname as patMname",
        )->leftJoin("patients as pat", "pending_meetings.patient_id", "=", "pat.id");
        if($keyword_req){
            $date_start = date('Y-m-d',strtotime(explode(' - ',$request->date_range_req)[0]));
            $date_end = date('Y-m-d',strtotime(explode(' - ',$request->date_range_req)[1]));
            $data_req = $data_req
                ->where(function($q) use($date_start, $date_end) {
                $q->whereDate('pending_meetings.datefrom', '>=', $date_start);
                $q->whereDate('pending_meetings.datefrom', '<=', $date_end);
            });
        }
        $status_req = $request->view_all_req ? '' : $request->status_req;
        $active_tab = $request->active_tab ? $request->active_tab : 'upcoming';
        if($status_req) {
            $data_req = $data_req->where(function($q) use($status_req) {
                $q->where('pending_meetings.status', $status_req);
            });
        }
        $data_req = $data_req->where("pending_meetings.doctor_id","=", $user->id)
                ->orderBy('pending_meetings.id', 'desc')
                ->paginate(20);

        $data_my_req = PendingMeeting::select(
            "pending_meetings.*",
            "pending_meetings.id as meetID",
            "pending_meetings.created_at as reqDate",
            "pat.lname as patLname",
            "pat.fname as patFname",
            "pat.mname as patMname",
        )->leftJoin("patients as pat", "pending_meetings.patient_id", "=", "pat.id")
        ->where("pending_meetings.user_id","=", $user->id)
                ->orderBy('pending_meetings.id', 'desc')
                ->paginate(5);
        $facilities = Facility::orderBy('facilityname', 'asc')->get();
        $count_req = PendingMeeting::select(
            "pending_meetings.*",
            "pending_meetings.id as meetID",
            "pending_meetings.created_at as reqDate",
        )->leftJoin("patients as pat", "pending_meetings.patient_id", "=", "pat.id")
        ->where('pending_meetings.status', 'Pending')
        ->where("pending_meetings.doctor_id","=", $user->id)->count();
        $telecat = DocCategory::orderBy('category_name', 'asc')->get();
        $labreq = LabRequest::where('req_type', 'LAB')->orderby('description', 'asc')->get();
        $imaging = LabRequest::where('req_type', 'RAD')->orderby('description', 'asc')->get();
        $docorder = DoctorOrder::where('doctorid', $user->id)->get();
        $zoomtoken = ZoomToken::where('facility_id',$user->facility_id)->first() ?
                        ZoomToken::where('facility_id',$user->facility_id)->first()->updated_at
                        : 'none';
        $doc_type = Doc_Type::where('isactive', '1')->orderBy('doc_name', 'asc')->get();
        return view('teleconsult.teleconsult',[
            'patients' => $patients,
            'search' => $keyword,
            'data' => $data,
            'pastmeetings' => $data_past,
            'search_past' => $keyword_past,
            'facilities' => $facilities,
            'search_req' => $keyword_req,
            'data_req' => $data_req,
            'status_req' => $status_req,
            'active_tab' => $active_tab,
            'data_my_req' => $data_my_req,
            'active_user' => $user,
            'pending' => $count_req,
            'telecat' => $telecat,
            'labreq' => $labreq,
            'imaging' => $imaging,
            'docorder' => $docorder,
            'zoomtoken'=> $zoomtoken,
            'doc_type'=> $doc_type
        ]);
    }

    public function schedTeleStore(Request $req) {
        $req->request->add([
            'status' => 'Pending'
        ]);
        if($req->meeting_id) {
            PendingMeeting::find($req->meeting_id)->update($req->except('meeting_id', 'facility_id'));
        } else {
            $data = PendingMeeting::create($req->except('meeting_id', 'facility_id'));
        }
        event(new ReqTele($data));
        Session::put("action_made","Please wait for the confirmation of doctor.");
    }

    public function indexCall($id) {
        $user = Session::get('auth');
        $decid = Crypt::decrypt($id);
    	$meetings = Meeting::select(
    		"meetings.*",
            "pat.id as PATID",
    		"meetings.id as meetID"
    	)->leftJoin("patients as pat","pat.id","=","meetings.patient_id")
         ->where('meetings.id',$decid)
        ->first();
        $api_key = env('ZOOM_API_KEY');
        $api_secret = env('ZOOM_API_SECRET');
        $meeting_number = $meetings->meeting_id;
        $password = $meetings->password;
        $role = $meetings->doctor_id == $user->id ? 1 : 0;
        $username = $user->fname.' '.$user->mname.' '.$user->lname;
        //Set the timezone to UTC
        date_default_timezone_set("UTC");

        $time = time() * 1000 - 30000;//time in milliseconds (or close enough)
        
        $data = base64_encode($api_key . $meeting_number . $time . $role);
        
        $hash = hash_hmac('sha256', $data, $api_secret, true);
        
        $_sig = $api_key . "." . $meeting_number . "." . $time . "." . $role . "." . base64_encode($hash);
        $signature = rtrim(strtr(base64_encode($_sig), '+/', '-_'), '=');
        $nationality = Countries::orderBy('nationality', 'asc')->get();
        $patient = Meeting::find($decid);
        $case_no = $patient->demoprof ? $patient->demoprof->case_no : sprintf('%09d', $patient->id);
        $facility = Facility::orderBy('facilityname', 'asc')->get();
        $countries = Countries::orderBy('en_short_name', 'asc')->get();
        $date_departure = '';
        $date_arrival_ph = '';
        $date_contact_known_covid_case = '';
        $acco_date_last_expose = '';
        $food_es_date_last_expose = '';
        $store_date_last_expose = '';
        $fac_date_last_expose = '';
        $event_date_last_expose = '';
        $wp_date_last_expose = '';
        $list_name_occasion = [];
        $days_14_date_onset_illness = '';
        $referral_date = '';
        $xray_date = '';
        $date_collected = '';
        $date_sent_ritm = '';
        $date_received_ritm = '';
        $scrum = [];
        $oro_naso_swab = [];
        $spe_others = [];
        $outcome_date_discharge = '';
        $conjunctiva = '';
        $neck = '';
        $breast = '';
        $thorax = '';
        $abdomen = '';
        $genitals = '';
        $extremities = '';
        if($patient->covidscreen) {
            $date_departure = $patient->covidscreen->date_departure ? date('m/d/Y', strtotime($patient->covidscreen->date_departure)) : '';
            $date_arrival_ph = $patient->covidscreen->date_arrival_ph ? date('m/d/Y', strtotime($patient->covidscreen->date_arrival_ph)) : '';
            $date_contact_known_covid_case = $patient->covidscreen->date_contact_known_covid_case ? date('m/d/Y', strtotime($patient->covidscreen->date_contact_known_covid_case)) : '';
            $acco_date_last_expose = $patient->covidscreen->acco_date_last_expose ? date('m/d/Y', strtotime($patient->covidscreen->acco_date_last_expose)) : '';
            $food_es_date_last_expose = $patient->covidscreen->food_es_date_last_expose ? date('m/d/Y', strtotime($patient->covidscreen->food_es_date_last_expose)) : '';
            $store_date_last_expose = $patient->covidscreen->store_date_last_expose ? date('m/d/Y', strtotime($patient->covidscreen->store_date_last_expose)) : '';
            $fac_date_last_expose = $patient->covidscreen->fac_date_last_expose ? date('m/d/Y', strtotime($patient->covidscreen->fac_date_last_expose)) : '';
            $event_date_last_expose = $patient->covidscreen->event_date_last_expose ? date('m/d/Y', strtotime($patient->covidscreen->event_date_last_expose)) : '';
            $wp_date_last_expose = $patient->covidscreen->wp_date_last_expose ? date('m/d/Y', strtotime($patient->covidscreen->wp_date_last_expose)) : '';
            $list_name_occasion = $patient->covidscreen->list_name_occasion ? explode("|",$patient->covidscreen->list_name_occasion) : [];
        }
        if($patient->covidassess) {
            $days_14_date_onset_illness = $patient->covidassess->days_14_date_onset_illness ? date('m/d/Y', strtotime($patient->covidassess->days_14_date_onset_illness)) : '';
            $referral_date = $patient->covidassess->referral_date ? date('m/d/Y', strtotime($patient->covidassess->referral_date)) : '';
            $xray_date = $patient->covidassess->xray_date ? date('m/d/Y', strtotime($patient->covidassess->xray_date)) : '';
            $date_collected = $patient->covidassess->date_collected ? date('m/d/Y', strtotime($patient->covidassess->date_collected)) : '';
            $date_sent_ritm = $patient->covidassess->date_sent_ritm ? date('m/d/Y', strtotime($patient->covidassess->date_sent_ritm)) : '';
            $date_received_ritm = $patient->covidassess->date_received_ritm ? date('m/d/Y', strtotime($patient->covidassess->date_received_ritm)) : '';
            $scrum = $patient->covidassess->scrum ? explode("|",$patient->covidassess->scrum) : [];
            $oro_naso_swab = $patient->covidassess->oro_naso_swab ? explode("|",$patient->covidassess->oro_naso_swab) : [];
            $spe_others = $patient->covidassess->spe_others ? explode("|",$patient->covidassess->spe_others) : [];
            $outcome_date_discharge = $patient->covidassess->outcome_date_discharge ? date('m/d/Y', strtotime($patient->covidassess->outcome_date_discharge)) : '';
        }
        if($patient->phyexam) {
            $conjunctiva = $patient->phyexam->conjunctiva;
            $neck = $patient->phyexam->neck;
            $breast = $patient->phyexam->breast;
            $thorax = $patient->phyexam->thorax;
            $abdomen = $patient->phyexam->abdomen;
            $genitals = $patient->phyexam->genitals;
            $extremities = $patient->phyexam->extremities;
        }
        $municity =  MunicipalCity::all();
        return view('teleconsult.teleCall',[
            'nationality' => $nationality,
            'municity' => $municity,
        	'meeting' => $meetings,
            'case_no' => $case_no,
            'patient' => $patient,
            'facility' => $facility,
            'countries' =>$countries,
            'date_departure' => $date_departure,
            'date_arrival_ph' => $date_arrival_ph,
            'date_contact_known_covid_case' => $date_contact_known_covid_case,
            'acco_date_last_expose' => $acco_date_last_expose,
            'food_es_date_last_expose' => $food_es_date_last_expose,
            'store_date_last_expose' => $store_date_last_expose,
            'fac_date_last_expose' => $fac_date_last_expose,
            'event_date_last_expose' => $event_date_last_expose,
            'wp_date_last_expose' => $wp_date_last_expose,
            'list_name_occasion' => $list_name_occasion,
            'days_14_date_onset_illness' => $days_14_date_onset_illness,
            'referral_date' => $referral_date,
            'xray_date' => $xray_date,
            'date_collected' => $date_collected,
            'date_sent_ritm' => $date_sent_ritm,
            'date_received_ritm' => $date_received_ritm,
            'scrum' => $scrum,
            'oro_naso_swab' => $oro_naso_swab,
            'spe_others' => $spe_others,
            'outcome_date_discharge' => $outcome_date_discharge,
            'signature'=>$signature,
            'api_key'=>$api_key,
            'meetnum'=>$meeting_number,
            'passw'=>$password,
            'username'=>$username,
            'role'=> $role,
            'conjunctiva' => $conjunctiva,
            'neck' => $neck,
            'breast' => $breast,
            'thorax' => $thorax,
            'abdomen' => $abdomen,
            'genitals' => $genitals,
            'extremities' => $extremities
        ]);
    }

    public function validateDateTime(Request $req) {
        $user = Session::get('auth');
    	$date = Carbon::parse($req->date)->format('Y-m-d');
    	$time = $req->time ? Carbon::parse($req->time)->format('H:i:s') : '';
        $doctor_id = $req->doctor_id ? $req->doctor_id : $user->id;
    	$endtime = Carbon::parse($time)
		            ->addMinutes($req->duration)
		            ->format('H:i:s');
		$meetings = Meeting::whereDate('date_meeting','=', $date)->where(function($q) use($doctor_id, $user) {
                $q->where('doctor_id', $doctor_id)
                ->orWhere('doctor_id', $user->id);
                })->get();
        $othermeetings = Meeting::whereDate('date_meeting','=', $date)
                ->whereHas('doctor', function ($query) use($user) {
                    return $query->where('facility_id',$user->facility_id);
                })->get();
		$count = 1;
        if($date === Carbon::now()->format('Y-m-d') && $time <= Carbon::now()->addMinutes('180')->format('H:i:s') && $time) {
            return 'Not valid';
        }
		foreach ($meetings as $meet) {
			if(($time >= $meet->from_time && $time <= $meet->to_time) || ($endtime >= $meet->from_time && $endtime <= $meet->to_time) || ($meet->from_time >= $time && $meet->to_time <= $endtime) || ($meet->from_time >= $time && $meet->to_time <= $endtime)) {
				return $meet->count();
			}
		}
        foreach ($othermeetings as $meet) {
            if(($time >= $meet->from_time && $time <= $meet->to_time) || ($endtime >= $meet->from_time && $endtime <= $meet->to_time) || ($meet->from_time >= $time && $meet->to_time <= $endtime) || ($meet->from_time >= $time && $meet->to_time <= $endtime)) {
                
                return $meet->count();
            }
        }
    }

    public function adminMeetingInfo(Request $req) {
    	$meeting = Meeting::select(
    		"meetings.*",
    		"pat.*",
    		"meetings.id as meetID",
    		"user.fname as docfname",
    		"user.mname as docmname",
    		"user.lname as doclname",
    	)->leftJoin("patients as pat","pat.id","=","meetings.patient_id")
    	->leftJoin("users as user", "user.id", "=", "pat.doctor_id")
         ->where('meetings.id',$req->meet_id)
        ->first();

    	return json_encode($meeting);
    }

    public function meetingInfo(Request $req) {
    	$meeting = Meeting::select(
    		"meetings.*",
    		"pat.*",
    		"meetings.id as meetID",
            "d.case_no as caseNO"
    	)->leftJoin("patients as pat","pat.id","=","meetings.patient_id")
        ->leftJoin("tele_demographic_profile as d","d.meeting_id","=","meetings.id")
         ->where('meetings.id',$req->meet_id)
        ->first();

    	return json_encode($meeting);
    }

    public function getPendingMeeting($id) {
        $pend_meet = PendingMeeting::find($id);
        $encoded = $pend_meet->encoded->facility;
        $patient = $pend_meet->patient;
        return response()->json($pend_meet);
    }

    public function acceptDeclineMeeting($id, Request $req) {
        $user = Session::get('auth');
        $userfac = $user->facility->facilityname;
        $meet = PendingMeeting::find($id);
        $action = $req->action;
        $date = date('Y-m-d', strtotime($req->date_from));
        $time = date('H:i:s', strtotime($req->time));
        $endtime = Carbon::parse($time)
                            ->addMinutes($req->duration)
                            ->format('H:i:s');
        $start = $date.'T'.$time;
        $duration = $req->duration;
        $patient = $meet->patient->lname.', '.$meet->patient->fname.' '.$meet->patient->mname;
        $password = 'doh'.str_random(3);
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.zoom.us']);
        if($action == 'Accept') {
            $db = ZoomToken::where('facility_id',$user->facility_id)->first();
            $arr_token = json_decode($db->provider_value);
            $accessToken = $arr_token->access_token;
            $response = $client->request('POST', '/v2/users/me/meetings', [
                "headers" => [
                    "Authorization" => "Bearer $accessToken"
                ],
                'json' => [
                    "topic" => $meet->title,
                    "type" => 2,
                    "start_time" => $start,
                    "duration" => $duration,
                    "password" => $password
                ],
            ]);
      
            $data = json_decode($response->getBody(), true);
            $create_data = array(
                'user_id' => $meet->user_id,
                'doctor_id' => $meet->doctor_id,
                'patient_id' => $meet->patient_id,
                'date_meeting' => $date,
                'from_time' => $time,
                'to_time' => $endtime,
                'meeting_id' => $data['id'],
                'title' => $data['topic'],
                'password' => $data['password'],
                'web_link' => $data['join_url'],
            );
            $create_meeting = Meeting::create($create_data);
        }
        $meet_id = $action == 'Accept' ? $create_meeting->id : null;
        $data = array(
            'status' => $action,
            'meet_id' => $meet_id
        );
        $meet->update($data); 
        if($action == 'Accept') {
            event(new AcDecReq($user, $create_meeting, $action, $userfac));
            Session::put("action_made","Successfully Accept Teleconsultation.");
        } else {
            event(new AcDecReq($user, $meet, $action, $userfac));
            Session::put("delete_action","Successfully Declined Teleconsultation.");
        }
    }

    public function getDocOrder(Request $req) {
        $docorder = DoctorOrder::find($req->docorderid);
        $labreq = $docorder ? $docorder->labreq : '';
        return response()->json([
            'docorder'=>$docorder,
            'labreq'=>$labreq
        ]);
    }

    public function labreqStore(Request $req) {
        $user = Session::get('auth');
        $fac_id = Session::get('auth')->facility->id;
        $files = $req->file('file');
        $pat_id = $req->doctororder_patient_id;
        if($req->hasFile('file'))
        {
            foreach ($files as $file) {
                $name = str_replace(' ', '', $file->getClientOriginalName());
                $file->move(public_path('labrequest').'/'.$fac_id.'/'.$pat_id,$name);
                $path = 'labrequest/'.$fac_id.'/'.$pat_id.'/'.$name;
                $data = array(
                    'docorderid' => $req->doctororder_id,
                    'doctypeid' => $req->doc_type,
                    'description' =>$req->description,
                    'filepath' => $path,
                    'filename'=> pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME),
                    'extensionname'=>pathinfo($name, PATHINFO_EXTENSION),
                    'uploadedby'=> $user->id
                );
                DocOrderLabReq::create($data);
            }
        }
        Session::put("action_made","Successfully Add Lab Request.");

    }

    public function zoomToken(Request $req) {
        $facility_id = Session::get('auth')->facility_id;
        $client_id = env('ZOOM_CLIENT_ID');
        $client_secret = env('ZOOM_CLIENT_SECRET');
        $direct_url = env('ZOOM_REDIRECT_URL');
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://zoom.us']);
  
        $response = $client->request('POST', '/oauth/token', [
            "headers" => [
                "Authorization" => "Basic ". base64_encode($client_id.':'.$client_secret)
            ],
            'form_params' => [
                "grant_type" => "authorization_code",
                "code" => $req->code,
                "redirect_uri" => $direct_url
            ],
        ]);

        $token = json_decode($response->getBody()->getContents(), true);
        $data = array('facility_id' => $facility_id,'provider' => 'zoom', 'provider_value' => json_encode($token) );
        $zoomtoken = ZoomToken::where('facility_id',$facility_id)->first() ?  ZoomToken::where('facility_id',$facility_id)->first()->update($data) : ZoomToken::create($data);
        echo "Your access token was Successfully Refresh. You can close this tab now.";
    }

    public function refreshToken(Request $req) {
        $facility_id = Session::get('auth')->facility_id;
        $zoomtoken = ZoomToken::where('facility_id',$facility_id)->first();
        return json_encode($zoomtoken);
        
    }

    public function thankYouPage(Request $req) {
        return view('thankyou');
    }

    public function calendarMeetings(Request $req) {
        $user = Session::get('auth');
        $data = Meeting::select(
            "meetings.*",
            "meetings.id as meetID",
            "meetings.user_id as Creator",
            "meetings.doctor_id as RequestTo",
            "pat.lname as patLname",
            "pat.fname as patFname",
            "pat.mname as patMname",
            "pat.id as PatID",
            "users.facility_id as facid"
        )->leftJoin("patients as pat", "meetings.patient_id", "=", "pat.id")
        ->leftJoin("users as users", "meetings.doctor_id", "=", "users.id")
        ->leftJoin("users as use", "meetings.user_id", "=", "users.id");
        $data = $data->where(function($q) use($user){
            $q->where("meetings.doctor_id","=", $user->id)
            ->orWhere("meetings.user_id", "=", $user->id)
            ->orWhere("meetings.user_id", "=", $user->id)
            ->orWhere("users.facility_id", "=", $user->facility_id)
            ->orWhere("use.facility_id", "=", $user->facility_id);
            })->orderBy('meetings.date_meeting', 'asc')
            ->get();
        $result = [];
        $join = '';
        foreach ($data as $value) {
            if($value->RequestTo == $user->id) {
              $join = 'no';
            } else if($value->Creator == $user->id) {
              $join = 'yes';
            }
            $values = array(
                'id' => $value->id,
                'title' => $value->title,
                'start' => $value->date_meeting.'T'.$value->from_time,
                'end' => $value->date_meeting.'T'.$value->to_time,
                'allow' => $join
            );
            array_push($result, $values);
        }
        return json_encode($result);
    }

    public function getDoctorsFacility(Request $req) {
        $user_id = Session::get('auth')->id;
        $doctors = User::where('facility_id',$req->fac_id)
                        ->where('doc_cat_id', $req->cat_id)
                        ->where('level', 'doctor')
                        ->where('id', '!=', $user_id)
                        ->orderBy('lname', 'asc')->get();
        return json_encode($doctors);
    }

    public function teleconsultDetails($id) {
        $decid = Crypt::decrypt($id);
        $meeting = Meeting::find($decid);
        return view('teleconsult.teledetails',[
            'meeting' => $meeting
        ]);
    }

    public function mycalendarMeetings(Request $req) {
        $user = Session::get('auth');
        $data = Meeting::select(
            "meetings.*",
            "meetings.id as meetID",
            "meetings.user_id as Creator",
            "meetings.doctor_id as RequestTo",
            "pat.lname as patLname",
            "pat.fname as patFname",
            "pat.mname as patMname",
            "pat.id as PatID",
        )->leftJoin("patients as pat", "meetings.patient_id", "=", "pat.id");
        $data = $data->where(function($q) use($user){
            $q->where("meetings.doctor_id","=", $user->id)
            ->orWhere("meetings.user_id", "=", $user->id);
            })->orderBy('meetings.date_meeting', 'asc')
            ->get();
        $result = [];
        $join = '';
        foreach ($data as $value) {
            if($value->RequestTo == $user->id) {
              $join = 'no';
            } else if($value->Creator == $user->id) {
              $join = 'yes';
            }
            $values = array(
                'id' => $value->id,
                'title' => $value->title,
                'start' => $value->date_meeting.'T'.$value->from_time,
                'end' => $value->date_meeting.'T'.$value->to_time,
                'allow' => $join
            );
            array_push($result, $values);
        }
        return json_encode($result);
    }
}
