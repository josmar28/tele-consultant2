<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::Auth();
Route::get('/', 'Auth\LoginController@index');
Route::get('/register', 'Auth\LoginController@registerIndex');
Route::post('login', 'Auth\LoginController@login');
Route::post('register-account', 'Auth\LoginController@register');
Route::get('/places/{id}/{type}', 'Auth\LoginController@getMunandBrgy');
Route::get('/get-doctor/{id}', 'Auth\LoginController@getDoctor');
Route::get('/validate-email', 'Auth\LoginController@validateEmail');
Route::get('/validate-username', 'Auth\LoginController@validateUsername');
Route::get('/logout', function(){
    $user = \Illuminate\Support\Facades\Session::get('auth');
    \Illuminate\Support\Facades\Session::flush();
    if(isset($user)){
        \App\User::where('id',$user->id)
            ->update([
                'login_status' => 'logout'
            ]);
        $logout = date('Y-m-d H:i:s');
        $logoutId = \App\Login::where('user_id',$user->id)
            ->orderBy('id','desc')
            ->first()
            ->id;

        \App\Login::where('id',$logoutId)
            ->update([
                'status' => 'login_off',
                'logout' => $logout
            ]);
    }
    return redirect('/');
});
// SuperSuperadmin Module
Route::get('superadmin','Superadmin\HomeController@index');
Route::get('/users', 'Superadmin\ManageController@indexUser');
Route::post('/user-deactivate/{id}', 'Superadmin\ManageController@deactivateUser');
Route::post('/user-store', 'Superadmin\ManageController@storeUser');
Route::get('/facilities', 'Superadmin\ManageController@indexFacility');
Route::get('/facilities/{id}/{type}', 'Superadmin\ManageController@getMunandBrgy');
Route::post('/facility-store', 'Superadmin\ManageController@storeFacility');
Route::post('/facility-delete/{id}', 'Superadmin\ManageController@deleteFacility');
Route::get('/provinces', 'Superadmin\ManageController@indexProvince');
Route::post('/province-store', 'Superadmin\ManageController@storeProvince');
Route::post('/province-delete/{id}', 'Superadmin\ManageController@deleteProvince');
Route::match(['GET','POST'],'/municipality/{province_id}/{province_name}','Superadmin\ManageController@viewMunicipality');
Route::post('/municipality-store', 'Superadmin\ManageController@storeMunicipality');
Route::post('/municipality-delete/{id}', 'Superadmin\ManageController@deleteMunicipality');
Route::match(['GET','POST'],'/barangay/{prov_id}/{prov_name}/{mun_id}/{mun_name}','Superadmin\ManageController@viewBarangay');
Route::post('/barangay-store', 'Superadmin\ManageController@storeBarangay');
Route::post('/barangay-delete/{id}', 'Superadmin\ManageController@deleteBarangay');
Route::match(['GET','POST'],'/diagnosis', 'Superadmin\DiagnosisController@indexDiagnosis');
Route::get('/diagnosis/{id}/maincat', 'Superadmin\DiagnosisController@getSubCategory');
Route::post('/superadmin-diagnosis-store', 'Superadmin\DiagnosisController@storeDiagnosis');
Route::post('/diagnosis-delete/{id}', 'Superadmin\DiagnosisController@deleteDiagnosis');
Route::match(['GET','POST'],'/diagnosis-main-category', 'Superadmin\DiagnosisController@indexDiagMainCat');
Route::post('/main-cat-store', 'Superadmin\DiagnosisController@storeMainCat');
Route::post('/main-cat-delete/{id}', 'Superadmin\DiagnosisController@deleteMainCat');
Route::match(['GET','POST'],'/diagnosis-sub-category', 'Superadmin\DiagnosisController@indexDiagSubCat');
Route::post('/sub-cat-store', 'Superadmin\DiagnosisController@storeSubCat');
Route::post('/sub-cat-delete/{id}', 'Superadmin\DiagnosisController@deleteSubCat');
Route::get('/doctor-option/{id}', 'Superadmin\ManageController@getDoctors');
Route::get('/audit-trail', 'Superadmin\ManageController@indexAudit');
Route::get('/doctor-category', 'Superadmin\ManageController@indexTeleCat');
Route::post('/doctor-category-store', 'Superadmin\ManageController@storeDoccat');
Route::post('/doctor-category-delete/{id}', 'Superadmin\ManageController@deleteDoccat');


//Admin Module
Route::get('admin','Admin\HomeController@index');
Route::get('/admin-facility','Admin\ManageController@AdminFacility');
Route::post('/update-facility','Admin\ManageController@updateFacility');
Route::match(['GET','POST'],'/admin-patient','Admin\ManageController@patientList');

Route::get('/admin-patient-meeting-info','Admin\ManageController@meetingInfo');

Route::get('/admin-join-meeting','Admin\TeleController@joinMeeting');


Route::get('/admin-doctors','Admin\ManageController@indexDoctors');


// Doctor Module
Route::get('doctor','Doctor\HomeController@index');
Route::match(['GET','POST'],'doctor/patient/list','Doctor\PatientController@patientList');
Route::match(['GET','POST'],'doctor/patient/update','Doctor\PatientController@patientUpdate');
Route::get('location/barangay/{muncity_id}','Doctor\PatientController@getBaranggays');
Route::match(['GET','POST'],'/patient-store', 'Doctor\PatientController@storePatient');
Route::post('/patient-delete/{id}', 'Doctor\PatientController@deletePatient');
Route::get('/patient-information/{id}', 'Doctor\PatientController@patientInformation');

Route::post('/webex-token', 'Doctor\TeleConsultController@storeToken');
Route::post('/patient-accept/{id}', 'Doctor\PatientController@acceptPatient');
Route::post('/patient-consult-info/{id}', 'Doctor\PatientController@patientConsultInfo');
Route::get('/tele-details','Doctor\PatientController@teleDetails');


Route::match(['GET','POST'],'doctor/prescription','Doctor\ManageController@prescription');
Route::post('/prescription-store', 'Doctor\ManageController@prescriptionStore');
Route::post('/prescription-delete/{id}', 'Doctor\ManageController@prescriptionDelete');
Route::match(['GET','POST'],'doctor/order','Doctor\ManageController@doctorOrder');
Route::post('/docorder-store', 'Doctor\ManageController@doctorOrderStore');
Route::post('/docorder-delete/{id}', 'Doctor\ManageController@docorderDelete');
Route::post('/medical-history-store', 'Doctor\PatientController@medHisStore');
Route::get('/medical-history-info','Doctor\PatientController@medHisData');

// Patient Module 
Route::get('patient','Patient\HomeController@index');

Route::get('/patient/clinical/{id}','Patient\PatientController@clinical');
Route::post('/clinical-store','Patient\PatientController@clinicalStore');
Route::get('/patient/covid/{id}','Patient\PatientController@covid');
Route::post('/covid-store','Patient\PatientController@covidStore');
Route::post('/assess-store','Patient\PatientController@assessStore');
Route::get('/patient/diagnosis/{id}','Patient\PatientController@diagnosis');
Route::post('/diagnosis-store','Patient\PatientController@diagnosisStore');
Route::get('/patient/plan/{id}','Patient\PatientController@plan');
Route::post('/plan-store','Patient\PatientController@planStore');
Route::post('/demographic-store','Patient\PatientController@demographicStore');
Route::post('/physical-exam-store','Patient\PatientController@phyExamStore');

//JM superadmin //Drugs/Meds
Route::get('drugsmeds/', 'Superadmin\DrugsMedsCtrl@index'); 
Route::post('drugsmeds/', 'Superadmin\DrugsMedsCtrl@index'); 
Route::post('drugmeds/drugsmeds_body', 'Superadmin\DrugsMedsCtrl@drugsmedsBody');
Route::post('drugsmeds/drugsmeds/delete', 'Superadmin\DrugsMedsCtrl@drugsmedsDelete');
Route::post('drugsmeds/drugsmeds/add', 'Superadmin\DrugsMedsCtrl@drugsmedsOptions');
Route::get('drugsmeds/unitofmes', 'Superadmin\DrugsMedsCtrl@unitofmesIndex');
Route::post('drugsmeds/unitofmes', 'Superadmin\DrugsMedsCtrl@unitofmesIndex');
Route::post('drugmeds/unitofmes_body', 'Superadmin\DrugsMedsCtrl@unitofmesBody');
Route::post('drugsmeds/unitofmes/add', 'Superadmin\DrugsMedsCtrl@unitofmesOptions'); 
Route::post('drugmeds/unitofmes/delete', 'Superadmin\DrugsMedsCtrl@unitofmesDelete');
Route::get('drugsmeds/subcategory', 'Superadmin\DrugsMedsCtrl@subcatIndex');
Route::post('drugsmeds/subcategory', 'Superadmin\DrugsMedsCtrl@subcatIndex');
Route::post('drugmeds/subcat_body', 'Superadmin\DrugsMedsCtrl@subcatBody');
Route::post('drugsmeds/subcat/add', 'Superadmin\DrugsMedsCtrl@subcatOptions');
Route::post('drugsmeds/subcat/delete', 'Superadmin\DrugsMedsCtrl@subcatDelete');

//Doc type
Route::get('document/type', 'Superadmin\DocumentCtrl@index');
Route::post('document/type', 'Superadmin\DocumentCtrl@index');
Route::post('superadmin/doc_type/body', 'Superadmin\DocumentCtrl@doctypeBody');
Route::post('superadmin/doc_type/add', 'Superadmin\DocumentCtrl@doctypeOptions'); 
Route::post('superadmin/doc_type/delete', 'Superadmin\DocumentCtrl@doctypeDelete');

//Lab Request
Route::get('superadmin/lab_request', 'Superadmin\LabRequestCtrl@index');
Route::post('superadmin/lab_request', 'Superadmin\LabRequestCtrl@index');
Route::post('superadmin/lab_request/body', 'Superadmin\LabRequestCtrl@labrequestBody');
Route::post('superadmin/lab_request/add', 'Superadmin\LabRequestCtrl@labrequestOptions'); 
Route::post('superadmin/lab_request/delete', 'Superadmin\LabRequestCtrl@labrequestDelete');

//Audit Trail 2
Route::get('superadim/audit-trail', 'Superadmin\AuditTrailCtrl@index');
Route::post('superadim/audit-trail', 'Superadmin\AuditTrailCtrl@index');

//feedback
Route::match(['get','post'] ,'feedback', 'FeedbackCtrl@index');
Route::match(['get','post'] ,'feedback/view', 'FeedbackCtrl@view');

//super admin feedback supderadmin/feedback
Route::match(['get','post'] ,'superadmin/feedback', 'FeedbackCtrl@sindex');
Route::post('superadmin/sfeedback_body', 'FeedbackCtrl@sindexBody'); 
Route::post('superadmin/feedback/response', 'FeedbackCtrl@sfeedbackResponse');

//issue and concern
Route::match(['get','post'] ,'doctor/issuesconcern', 'Doctor\IssueConcernCtrl@index');
Route::get('issue/concern/{meet_id}/{issue_from}','Doctor\IssueConcernCtrl@IssueAndConcern'); 
Route::post('issue/concern/submit','Doctor\IssueConcernCtrl@issueSubmit');

//Teleconsult
Route::get('/start-zoom-meeting','Doctor\TeleConsultController@zoomMeeting');
Route::get('/getToken','Tele\TeleController@zoomToken');
Route::match(['GET','POST'],'/teleconsultation','Tele\TeleController@index');
Route::match(['GET','POST'],'/sched-pending','Tele\TeleController@schedTeleStore');
Route::get('/join-meeting/{id}','Tele\TeleController@indexCall');
Route::get('/start-meeting/{id}','Tele\TeleController@indexCall');
Route::get('/validate-datetime','Tele\TeleController@validateDateTime');
Route::get('/admin-meeting-info','Tele\TeleController@adminMeetingInfo');
Route::get('/meeting-info','Tele\TeleController@meetingInfo');
Route::get('/get-pending-meeting/{id}', 'Tele\TeleController@getPendingMeeting');
Route::post('/accept-decline-meeting/{id}', 'Tele\TeleController@acceptDeclineMeeting');
Route::get('/doctor-order-info','Tele\TeleController@getDocOrder');
Route::post('/lab-request-doctor-order','Tele\TeleController@labreqStore');
Route::get('/refresh-token', 'Tele\TeleController@refreshToken');
Route::get('/thank-you-page', 'Tele\TeleController@thankYouPage');
Route::get('/calendar-meetings', 'Tele\TeleController@calendarMeetings');
Route::get('/my-calendar-meetings', 'Tele\TeleController@mycalendarMeetings');
Route::get('/get-doctors-facility','Tele\TeleController@getDoctorsFacility');
Route::get('/teleconsultation/details/{id}','Tele\TeleController@teleconsultDetails');

Route::get('/fetch-notification', 'Notification\NotifController@fetchNotif');
Route::get('/notif-patient-info/{id}', 'Notification\NotifController@patientInfo');
Route::post('/notif-patient-accept/{id}', 'Notification\NotifController@patientAccept');