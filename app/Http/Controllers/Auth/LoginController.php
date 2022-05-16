<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Login;
use Carbon\Carbon;
use App\Facility;
use App\Barangay;
use App\Countries;
use App\Region;
use App\MunicipalCity;
use App\Province;
use App\Patient;
use App\DocCategory;
use App\Events\ReqPatient;
class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function index()
    {
        if($login = Session::get('auth')){
            return redirect($login->level);
        }else{
            Session::flush();
            return view('auth.login');
        }
    }

    public function login(Request $req)
    {
        $login = User::where('username',$req->username)
            ->first();
        if($login && $login->status=='deactivate') {
            return Redirect::back()->withErrors(['msg' => 'Your account was deactivated by administrator.']);
        } else if($login && $login->is_accepted==0 && $login->level=='patient') {
            return Redirect::back()->withErrors(['msg' => 'This user is not accepted by facility, Please wait for the confirmation.']);
        }
        else if($login)
        {
            if(Hash::check($req->password,$login->password))
            {
                Session::put('auth',$login);
                $last_login = date('Y-m-d H:i:s');
                User::where('id',$login->id)
                    ->update([
                        'last_login' => $last_login,
                        'login_status' => 'login'
                    ]);
                $checkLastLogin = self::checkLastLogin($login->id);

                $l = new Login();
                $l->user_id = $login->id;
                $l->login = $last_login;
                $l->status = 'login';
                $l->save();

                if($checkLastLogin > 0 ){
                    Login::where('id',$checkLastLogin)
                        ->update([
                            'logout' => $last_login
                        ]);
                }
                if($login->level=='superadmin')
                    return redirect('superadmin');
                if($login->level=='admin' && $login->status=='active')
                    return redirect('admin');
                else if($login->level=='doctor' && $login->status=='active')
                    return redirect('doctor');
                else if($login->level=='officer' && $login->status=='active')
                    return redirect('officer');
                else if($login->level=='patient' && $login->status=='active')
                    return redirect('patient');
                else{
                    Session::forget('auth');
                    Session::put('username', $req->username);
                      return Redirect::back()->withErrors(['msg' => 'You don\'t have access in this system.']);
                }
            }
            else{
                Session::put('username', $req->username);
                return Redirect::back()->withErrors(['msg' => 'These credentials do not match our records.']);
            }
        }
        else{
            Session::put('username', $req->username);
            return Redirect::back()->withErrors(['msg' => 'These credentials do not match our records.']);
        }
    }

    function checkLastLogin($id)
    {
        $start = Carbon::now()->startOfDay();
        $end = Carbon::now()->endOfDay();
        $login = Login::where('user_id',$id)
                    ->whereBetween('login',[$start,$end])
                    ->orderBy('id','desc')
                    ->first();
        if($login && (!$login->logout>=$start && $login->logout<=$end)){
            return true;
        }

        if(!$login){
            return false;
        }

        return $login->id;
    }

    protected function credentials(Request $request)
    {
        return $request->only('username', 'password');
    }

    public function registerIndex() {
        $facility = Facility::orderBy('facilityname','asc')->get();
        $nationality = Countries::orderBy('nationality', 'asc')->get();
        $region = Region::find(13);
        $nationality_def = Countries::where('num_code', '608')->first();
        $municity =  MunicipalCity::all();
        $province = Province::where('reg_code',12)->get();
        $docat = DocCategory::orderBy('category_name','asc')->get();
        return view('auth.register',[
            'facilities' => $facility,
            'nationality' => $nationality,
            'nationality_def' => $nationality_def,
            'region' => $region,
            'municity' => $municity,
            'province' => $province,
            'doccat' => $docat
        ]);
    }

    public function getMunandBrgy($id, $type) {
        if($type === 'municipality') {
            $municipal = MunicipalCity::where('prov_psgc', '=', $id)->orderBy('muni_name', 'asc')->get();
            return response()->json(['municipal'=>$municipal]);
        } else if($type === 'barangay'){
            $barangay = Barangay::where('muni_psgc', '=', $id)->orderBy('brg_name', 'asc')->get();
            return response()->json(['barangay'=>$barangay]);
        } else if($type === 'province'){
            $province = Province::where('reg_code', '=', $id)->orderBy('prov_name', 'asc')->get();
            return response()->json(['province'=>$province]);
        }
    }
    public function register(Request $req) {
        $doctor_id = $req->doctor_id;
        $unique_id = $req->fname.' '.$req->mname.' '.$req->lname.mt_rand(1000000, 9999999);
        $data = array(
            'unique_id' => $unique_id,
            'doctor_id' => $doctor_id,
            'facility_id' => $req->facility_id,
            'phic_status' => $req->phic_status,
            'phic_id' => $req->phic_id,
            'fname' => $req->fname,
            'mname' => $req->mname,
            'lname' => $req->lname,
            'occupation' => $req->occupation,
            'nationality_id' => $req->nationality_id,
            'id_type' => $req->id_type,
            'id_type_no' => $req->id_type_no,
            'contact' => $req->contact,
            'dob' => $req->dob,
            'sex' => $req->sex,
            'civil_status' => $req->civil_status,
            'region' => $req->region,
            'house_no' => $req->house_no,
            'street' => $req->street,
            'muncity' => $req->muncity,
            'province' => $req->province,
            'brgy' => $req->brgy,
            'address' => $req->address,
            'tsekap_patient' => 0,
            'is_accepted' => 0
        );
        $patient = Patient::create($data);
        if($req->email && $req->username && $req->password) {
            $data = array(
                'fname' => $req->fname,
                'mname' => $req->mname,
                'lname' => $req->lname,
                'level' => 'patient',
                'facility_id' => $req->facility_id,
                'status' => 'active',
                'contact' => $req->contact,
                'email' => $req->email,
                'username' => $req->username,
                'password' => bcrypt($req->password),
                'is_accepted'=> 0
            );
            $account = User::find($patient->account_id);
            if($account) {
                $account->update($data);
            } else {
                $account = User::create($data);
                Patient::find($patient->id)->update([
                    'account_id' => $account->id
                ]);
            }
        }
        event(new ReqPatient($patient, $account));
        Session::put("action_made","Please wait for the confirmation of facility.");
            
    }

    public function getDoctor($id) {
        $doctors = User::where('facility_id', $id)->where('level', 'doctor')->orderBy('lname', 'asc')->get();
        return response()->json(['doctors'=>$doctors]);
    }

    public function getDoctorsFacility(Request $req) {
        $doctors = User::where('facility_id',$req->fac_id)
                        ->where('doc_cat_id', $req->cat_id)
                        ->where('level', 'doctor')
                        ->orderBy('lname', 'asc')->get();
        return json_encode($doctors);
    }

    public function validateEmail(Request $req) {
        $email = User::where('email', $req->email)->get();
        return $email;
    }
    public function validateUsername(Request $req) {
        $username = User::where('username', $req->username)->get();
        return $username;
    }
}
