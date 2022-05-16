<form id="patient_form" class="disAble">
    {{ csrf_field() }}
    <div class="row">
    <div class="col-sm-12">
        <button title="save" type="submit" class="pull-right btnSave btn btn-success hide"><i class="far fa-save"></i></button>
    </div>
     <div class="col-sm-6">
        <label class="reqField">PhilHealth Status:</label>
            <select class="form-control select_phic" name="phic_status" required>
                <option value="None">None</option>
                <option value="Member">Member</option>
                <option value="Dependent">Dependent</option>
            </select>
     </div>
     <div class="col-sm-6">
        <label>PhilHealth ID:</label>
        <input type="text" class="form-control phicID" value="" name="phic_id" disabled>
     </div>
     <div class="col-sm-6">
        <div class="form-group">
            <label reqField>First Name:</label>
            <input type="text" class="form-control" value="@if($patient->patient){{$patient->patient->fname}} @else {{$patient->fname}} @endif" name="fname" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Middle Name:</label>
            <input type="text" class="form-control" value="@if($patient->patient){{$patient->patient->mname}} @else {{$patient->mname}} @endif" name="mname">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="reqField">Last Name:</label>
            <input type="text" class="form-control" value="@if($patient->patient){{$patient->patient->lname}} @else {{$patient->lname}} @endif" name="lname" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="reqField">Contact Number:</label>
            <input type="text" class="form-control" value="@if($patient->patient){{$patient->patient->contact}} @else {{$patient->contact}} @endif" name="contact" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="reqField">Birth Date:</label>
            <input type="date" class="form-control" value="@if($patient->patient){{$patient->patient->dob}}@else{{$patient->dob}}@endif" min="1910-05-11" max="{{ date('Y-m-d') }}" name="dob" required>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="reqField">Sex:</label>
            <select class="form-control sex" name="sex" required>
                <option value="@if($patient->patient){{$patient->patient->sex}} @else {{$patient->sex}} @endif" selected>@if($patient->patient){{$patient->patient->sex}} @else {{$patient->sex}} @endif</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="reqField">Civil Status:</label>
            <select class="form-control civil_status" name="civil_status" required>
                <option value="@if($patient->patient){{$patient->patient->civil_status}} @else {{$patient->civil_status}} @endif" selected>@if($patient->patient){{$patient->patient->civil_status}} @else {{$patient->civil_status}} @endif</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Separated">Separated</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="reqField">Religion:</label>
            <select class="form-control civil_status select2" name="religion" required>
                <option value="@if($patient->patient){{$patient->patient->religion}} @else {{$patient->religion}} @endif" selected>@if($patient->patient){{$patient->patient->relgion()}} @else {{$patient->relgion()}} @endif</option>
                <option value="AGLIP">AGLIPAY</option><option value="ALLY">ALLIANCE OF BIBLE CHRISTIAN COMMUNITIES</option><option value="ANGLI">ANGLICAN</option><option value="BAPTI">BAPTIST</option><option value="BRNAG">BORN AGAIN CHRISTIAN</option><option value="BUDDH">BUDDHISM</option><option value="CATHO">CATHOLIC</option><option value="XTIAN">CHRISTIAN</option><option value="CHOG">CHURCH OF GOD</option><option value="EVANG">EVANGELICAL</option><option value="IGNIK">IGLESIA NI CRISTO</option><option value="MUSLI">ISLAM</option><option value="JEWIT">JEHOVAHS WITNESS</option><option value="MORMO">LDS-MORMONS</option><option value="LRCM">LIFE RENEWAL CHRISTIAN MINISTRY</option><option value="LUTHR">LUTHERAN</option><option value="METOD">METHODIST</option><option value="PENTE">PENTECOSTAL</option><option value="PROTE">PROTESTANT</option><option value="SVDAY">SEVENTH DAY ADVENTIST</option><option value="UCCP">UCCP</option><option value="UNKNO">UNKNOWN</option><option value="WESLY">WESLEYAN</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Educational Attainment:</label>
            <select class="form-control civil_status select2" name="edu_attain">
                <option value="@if($patient->patient){{$patient->patient->edu_attain}} @else {{$patient->edu_attain}} @endif" selected>@if($patient->patient){{$patient->patient->edattain()}} @else {{$patient->edattain()}} @endif</option>
                <option value=""> -- SELECT EDUCATIONAL ATTAINMENT --</option><option value="03">COLLEGE</option><option value="01">ELEMENTARY EDUCATION</option><option value="02">HIGH SCHOOL EDUCATION</option><option value="05">NO FORMAL EDUCATION</option><option value="06">NOT APPLICABLE</option><option value="04">POSTGRADUATE PROGRAM</option><option value="07">VOCATIONAL</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Occupation:</label>
            <input type="text" class="form-control" value="@if($patient->patient){{$patient->patient->occupation}} @else {{$patient->occupation}} @endif" name="occupation">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Monthly Income:</label>
            <input type="text" class="form-control" value="@if($patient->patient){{$patient->patient->monthly_income}} @else {{$patient->monthly_income}} @endif" name="monthly_income">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Select ID:</label>
            <select class="form-control id_type select21" name="id_type">
                <option value="@if($patient->patient){{$patient->patient->id_type}} @else {{$patient->id_type}} @endif">@if($patient->patient){{$patient->patient->idtype()}} @else {{$patient->idtype()}} @endif</option>
                <option value="umid">UMID</option>
                <option value="dl">DRIVER'S LICENSE</option>
                <option value="passport">PASSPORT ID</option>
                <option value="postal">POSTAL ID</option>
                <option value="tin">TIN ID</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label id="selectID" class="reqField">CRN:</label>
            <input id="idVal" name="id_type_no" type="text" class="form-control">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="reqField">Nationality:</label>
            <select class="form-control select2" name="nationality_id" required>
                <option value="@if($patient->patient){{$patient->patient->nationality->num_code}} @else {{$patient->nationality->num_code}} @endif" selected>@if($patient->patient){{$patient->patient->nationality->nationality}} @else {{$patient->nationality->nationality}} @endif</option>
                  @foreach($nationality as $n)
                    <option value="{{ $n->num_code }}">{{ $n->nationality }}</option>
                     @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>House no./Lot/Bldg:</label>
            <input type="text" class="form-control" value="@if($patient->patient){{$patient->patient->house_no}} @else {{$patient->house_no}} @endif" name="house_no">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Street:</label>
            <input type="text" class="form-control" value="@if($patient->patient){{$patient->patient->street}} @else {{$patient->street}} @endif" name="street">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="reqField">Region:</label>
            <select class="form-control select2" name="region" id="region" required>
                <option value="@if($patient->patient){{$patient->patient->reg->reg_code}} @else {{$patient->reg->reg_code}} @endif" selected>@if($patient->patient){{$patient->patient->reg_desc}} @else {{$patient->reg_desc}} @endif</option>
                <option value="">Select Region...</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Province:</label>
            <select class="form-control select2" name="province" id="province">
                <option value="@if($patient->patient){{$patient->patient->prov->prov_psgc}} @else {{$patient->prov->prov_psgc}} @endif" selected>@if($patient->patient){{$patient->patient->prov->prov_name}} @else {{$patient->prov->prov_name}} @endif</option>
                <option value="">Select Province...</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label class="reqField">Municipality:</label>
            <select class="form-control muncity filter_muncity select2" name="muncity" id="municipality" required>
                <option value="@if($patient->patient){{$patient->patient->muni->muni_psgc}} @else {{$patient->muni->muni_psgc}} @endif" selected>@if($patient->patient){{$patient->patient->muni->muni_name}} @else {{$patient->muni->muni_name}} @endif</option>
                <option value="">Select Municipal/City...</option>
                  @foreach($municity as $m)
                    <option value="{{ $m->muni_psgc }}">{{ $m->muni_name }}</option>
                     @endforeach 
                 <option value="others">Others</option>
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group barangay_holder">
            <label>Barangay:</label>
            <select class="form-control barangay select2" name="brgy" required>
                <option value="@if($patient->patient){{$patient->patient->barangay->brg_psgc}} @else {{$patient->barangay->brg_psgc}} @endif" selected>@if($patient->patient){{$patient->patient->barangay->brg_name}} @else {{$patient->barangay->brg_name}} @endif</option>
                <option value="">Select Barangay...</option>
            </select>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="has-group others_holder">
            <label>Complete Address :</label>
            <input type="text" name="address" value="@if($patient->patient){{$patient->patient->address}} @else {{$patient->address}} @endif" class="form-control others" placeholder="Enter complete address..." />
        </div>
    </div>
 </div>
</form>