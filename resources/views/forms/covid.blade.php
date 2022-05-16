<form id="covid_form" method="POST">
    {{ csrf_field() }}
    <div class="pull-right">
        <button title="save" type="submit" class="btnSaveCovid btn btn-success hide"><i class="far fa-save"></i></button>
    </div>
    <div class="">
        <div class="box-header with-border" style="background-color: #00a65a; color: white;">
            <h4 style="">Overseas Employment Address(for Overseas Filipino Workers)</h4>
        </div>  
        <div class="box-body">
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Employer's Name:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->employers_name }} @endif" name="employers_name">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Place Of Work:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->place_of_work }} @endif" name="place_of_work">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>House #/Bldg Name:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->house_bldg_name }} @endif" name="house_bldg_name">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Street:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->street }} @endif" name="street">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>City/Municipality:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->municipal }} @endif" name="municipal">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Province/State:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->province }} @endif" name="province">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Country:</label>
                        <select name="country_id" class="select2">
                            <option value="">Select Country</option>
                            @foreach($countries as $row)
                                <option value="{{ $row->num_code }}" @if($patient->covidscreen)@if($patient->covidscreen->country_id == $row->num_code)selected @endif @endif>{{ $row->en_short_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Office Phone No:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->office_phone_no }} @endif" name="office_phone_no">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Office Cellphone No:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->cellphone_no }} @endif" name="cellphone_no">
                    </div>
                </div>
            </div>
        </div>
        <div class="box-header with-border" style="background-color: #00a65a; color: white;">
            <h4 style="">Travel History</h4>
        </div>  
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <label>History of Travel/Visit/Work in other countries with known COVID-19 transmission 14 days prior to onset of signs and symptoms:</label>
                    <label class="radio-inline"><input type="radio" name="history_travel_country_symptoms" value="1" required @if($patient->covidscreen)@if($patient->covidscreen->history_travel_country_symptoms == 1)checked @endif @endif>Yes</label>
                    <label class="radio-inline"><input type="radio" name="history_travel_country_symptoms" value="0"  @if($patient->covidscreen)@if($patient->covidscreen->history_travel_country_symptoms == 0)checked @endif @endif>No</label>
                </div>
                <div class="col-md-4">
                    <br>
                    <div class="form-group">
                        <label>Port of Exit:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->port_of_exit }} @endif" name="port_of_exit">
                    </div>
                </div>
                <div class="col-md-4">
                    <br>
                    <div class="form-group">
                        <label>Airline/Sea Vessel:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->airline_sea_vessel }} @endif" name="airline_sea_vessel">
                    </div>
                </div>
                <div class="col-md-4">
                    <br>
                    <div class="form-group">
                        <label>Flight/Vessel #:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->flight_vessel_no }} @endif" name="flight_vessel_no">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date of Departure:</label>
                        <input type="text" class="form-control daterange" value="{{ $date_departure }}" name="date_departure">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date of Arrival in Philippines:</label>
                        <input type="text" class="form-control daterange" value="{{ $date_arrival_ph }}" name="date_arrival_ph">
                    </div>
                </div>
            </div>
        </div>
        <div class="box-header with-border" style="background-color: #00a65a; color: white;">
            <h4 style="">Exposure History</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <br>
                    <label>Known Covid-19 Case:</label>&nbsp;
                    <label class="radio-inline"><input type="radio" name="known_covid_case" value="1" required @if($patient->covidscreen)@if($patient->covidscreen->known_covid_case == 1)checked @endif @endif>Yes</label>
                    <label class="radio-inline"><input type="radio" name="known_covid_case" value="0"  @if($patient->covidscreen)@if($patient->covidscreen->known_covid_case == 0)checked @endif @endif>No</label>
                    <label class="radio-inline"><input type="radio" name="known_covid_case" value="2"  @if($patient->covidscreen)@if($patient->covidscreen->known_covid_case == 2)checked @endif @endif>Unknown</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>(If yes) Date of Contact with Known Covid-19 Case:</label>
                        <input type="text" class="form-control daterange" value="{{ $date_contact_known_covid_case }}" name="date_contact_known_covid_case" disabled>
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Accomodation:</label>&nbsp;
                        <label class="radio-inline"><input type="radio" name="accomodation" value="1" required @if($patient->covidscreen)@if($patient->covidscreen->accomodation == 1)checked @endif @endif>Yes</label>
                        <label class="radio-inline"><input type="radio" name="accomodation" value="0"  @if($patient->covidscreen)@if($patient->covidscreen->accomodation == 0)checked @endif @endif>No</label>
                        <label class="radio-inline"><input type="radio" name="accomodation" value="2"  @if($patient->covidscreen)@if($patient->covidscreen->accomodation == 2)checked @endif @endif>Unknown</label>
                    </div>
                    <div class="form-group">
                        <label>Specific Type:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->acco_specify_type }} @endif" name="acco_specify_type">
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->acco_address }} @endif" name="acco_address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date of Last Exposure:</label>
                        <input type="text" class="form-control daterange" value="{{ $acco_date_last_expose }}" name="acco_date_last_expose">
                    </div>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->acco_name }} @endif" name="acco_name">
                    </div>
                    <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="acco_name_type" value="1" @if($patient->covidscreen)@if($patient->covidscreen->acco_name_type == 1)checked @endif @endif>Guest</label>
                        <label class="radio-inline"><input type="radio" name="acco_name_type" value="0"  @if($patient->covidscreen)@if($patient->covidscreen->acco_name_type == 0)checked @endif @endif>Hotel Worker</label>
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Food Establishment:</label>&nbsp;
                        <label class="radio-inline"><input type="radio" name="food_establishment" value="1" required @if($patient->covidscreen)@if($patient->covidscreen->food_establishment == 1)checked @endif @endif>Yes</label>
                        <label class="radio-inline"><input type="radio" name="food_establishment" value="0"  @if($patient->covidscreen)@if($patient->covidscreen->food_establishment == 0)checked @endif @endif>No</label>
                        <label class="radio-inline"><input type="radio" name="food_establishment" value="2"  @if($patient->covidscreen)@if($patient->covidscreen->food_establishment == 2)checked @endif @endif>Unknown</label>
                    </div>
                    <div class="form-group">
                        <label>Specific Type:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->food_es_specify_type }} @endif" name="food_es_specify_type">
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->food_es_address }} @endif" name="food_es_address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date of Last Exposure:</label>
                        <input type="text" class="form-control daterange" value="{{ $food_es_date_last_expose }}" name="food_es_date_last_expose">
                    </div>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->food_es_name }} @endif" name="food_es_name">
                    </div>
                    <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="food_es_name_type" value="1" @if($patient->covidscreen)@if($patient->covidscreen->food_es_name_type == 1)checked @endif @endif>Diner</label>
                        <label class="radio-inline"><input type="radio" name="food_es_name_type" value="0"  @if($patient->covidscreen)@if($patient->covidscreen->food_es_name_type == 0)checked @endif @endif>Crew</label>
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Store:</label>&nbsp;
                        <label class="radio-inline"><input type="radio" name="store" value="1" required @if($patient->covidscreen)@if($patient->covidscreen->store == 1)checked @endif @endif>Yes</label>
                        <label class="radio-inline"><input type="radio" name="store" value="0"  @if($patient->covidscreen)@if($patient->covidscreen->store == 0)checked @endif @endif>No</label>
                        <label class="radio-inline"><input type="radio" name="store" value="2"  @if($patient->covidscreen)@if($patient->covidscreen->store == 2)checked @endif @endif>Unknown</label>
                    </div>
                    <div class="form-group">
                        <label>Specific Type:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->store_specify_type }} @endif" name="store_specify_type">
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->store_address }} @endif" name="store_address">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date of Last Exposure:</label>
                        <input type="text" class="form-control daterange" value="{{ $store_date_last_expose }}" name="store_date_last_expose">
                    </div>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->store_name }} @endif" name="store_name">
                    </div>
                    <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="store_name_type" value="1" @if($patient->covidscreen)@if($patient->covidscreen->store_name_type == 1)checked @endif @endif>Customer</label>
                        <label class="radio-inline"><input type="radio" name="store_name_type" value="0"  @if($patient->covidscreen)@if($patient->covidscreen->store_name_type == 0)checked @endif @endif>Worker</label>
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Health Facility:</label>&nbsp;
                        <label class="radio-inline"><input type="radio" name="facility" value="1" required @if($patient->covidscreen)@if($patient->covidscreen->facility == 1)checked @endif @endif>Yes</label>
                        <label class="radio-inline"><input type="radio" name="facility" value="0"  @if($patient->covidscreen)@if($patient->covidscreen->facility == 0)checked @endif @endif>No</label>
                        <label class="radio-inline"><input type="radio" name="facility" value="2"  @if($patient->covidscreen)@if($patient->covidscreen->facility == 2)checked @endif @endif>Unknown</label>
                    </div>
                    <div class="form-group">
                        <label>Specific Type:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->fac_specify_type }} @endif" name="fac_specify_type">
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->fac_address }} @endif" name="fac_address">
                    </div>
                    <div class="form-group">
                        <label>Significant Other:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->fac_significant_other }} @endif" name="fac_significant_other">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date of Last Exposure:</label>
                        <input type="text" class="form-control daterange" value="{{ $fac_date_last_expose }}" name="fac_date_last_expose">
                    </div>
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->fac_name }} @endif" name="fac_name">
                    </div>
                    <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="fac_name_type" value="1" @if($patient->covidscreen)@if($patient->covidscreen->fac_name_type == 1)checked @endif @endif>Patient</label>
                        <label class="radio-inline"><input type="radio" name="fac_name_type" value="0"  @if($patient->covidscreen)@if($patient->covidscreen->fac_name_type == 0)checked @endif @endif>Health Worker</label>
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Event:</label>&nbsp;
                        <label class="radio-inline"><input type="radio" name="event" value="1" required @if($patient->covidscreen)@if($patient->covidscreen->event == 1)checked @endif @endif>Yes</label>
                        <label class="radio-inline"><input type="radio" name="event" value="0"  @if($patient->covidscreen)@if($patient->covidscreen->event == 0)checked @endif @endif>No</label>
                        <label class="radio-inline"><input type="radio" name="event" value="2"  @if($patient->covidscreen)@if($patient->covidscreen->event == 2)checked @endif @endif>Unknown</label>
                    </div>
                    <div class="form-group">
                        <label>Specific Type:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->event_specify_type }} @endif" name="event_specify_type">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date of Last Exposure:</label>
                        <input type="text" class="form-control daterange" value="{{ $event_date_last_expose }}" name="event_date_last_expose">
                    </div>
                    <div class="form-group">
                        <label>Event Place:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->event_place }} @endif" name="event_place">
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Workplace:</label>&nbsp;
                        <label class="radio-inline"><input type="radio" name="workplace" value="1" required @if($patient->covidscreen)@if($patient->covidscreen->workplace == 1)checked @endif @endif>Yes</label>
                        <label class="radio-inline"><input type="radio" name="workplace" value="0"  @if($patient->covidscreen)@if($patient->covidscreen->workplace == 0)checked @endif @endif>No</label>
                        <label class="radio-inline"><input type="radio" name="workplace" value="2"  @if($patient->covidscreen)@if($patient->covidscreen->workplace == 2)checked @endif @endif>Unknown</label>
                    </div>
                    <div class="form-group">
                        <label>Company Name:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->wp_company_name }} @endif" name="wp_company_name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date of Last Exposure:</label>
                        <input type="text" class="form-control daterange" value="{{ $wp_date_last_expose }}" name="wp_date_last_expose">
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input type="text" class="form-control" value="@if($patient->covidscreen){{ $patient->covidscreen->wp_address }} @endif" name="wp_address">
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-12">
                    <label>List of names of persons in contact with during any of this occasions and their contact numbers:</label><br>
                    <button type="button" class="btnAddrow btn btn-success hide">Add row</button>
                    <br>
                    <br>
                    <div id="nameContact">
                        <div class="row">
                            @if(count($list_name_occasion) > 0)
                            @foreach($list_name_occasion as $row)
                            <div class="inputRow col-md-6">
                                <div class="inputRows form-group">
                                    <input type="text" name="list_name_occasion[]" class="form-control" placeholder="e.g John Doe - 1234567890" value="{{ $row }}">
                                    <div class="input-group-btn">
                                      <button class="btnRemoveRow btn btn-danger hide" type="button">Remove</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif  
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        </form>
        <form id="assess_form" method="POST">
        <div class="box-header with-border" style="background-color: #00a65a; color: white;">
            <h4 style="">Clinical Assessment</h4>
        </div>
        <div class="box-body">
            <input type="hidden" name="assess_id" value="@if($patient->covidassess){{ $patient->covidassess->id }} @endif">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label>14 days PRIOR to first date of Exposure:</label>&nbsp;
                        <label class="radio-inline"><input type="radio" name="days_14_prior_expose" value="1" required @if($patient->covidassess)@if($patient->covidassess->days_14_prior_expose == 1)checked @endif @endif>Yes</label>
                        <label class="radio-inline"><input type="radio" name="days_14_prior_expose" value="0"  @if($patient->covidassess)@if($patient->covidassess->days_14_prior_expose == 0)checked @endif @endif>No</label>
                    </div>
                    <div class="form-group">
                        <label>Anytime during date of Exposure:</label>&nbsp;
                        <label class="radio-inline"><input type="radio" name="anytime_during_expose" value="1" required @if($patient->covidassess)@if($patient->covidassess->anytime_during_expose == 1)checked @endif @endif>Yes</label>
                        <label class="radio-inline"><input type="radio" name="anytime_during_expose" value="0"  @if($patient->covidassess)@if($patient->covidassess->anytime_during_expose == 0)checked @endif @endif>No</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>(if yes)Date of onset of illness:</label>
                        <input type="text" class="form-control daterange" value="{{ $days_14_date_onset_illness }}" name="days_14_date_onset_illness">
                    </div>
                    <div class="form-group">
                        <label>Name of Referral Health Facility:</label>
                        <input type="text" class="form-control" value="@if($patient->covidassess){{ $patient->covidassess->name_facility }} @endif" name="name_facility">
                    </div>
                    <div class="form-group">
                        <label>Date of Referral:</label>
                        <input type="text" class="form-control daterange" value="{{ $referral_date }}" name="referral_date">
                    </div>
                </div>
                <div class="col-md-4">
                    <label>(If no) Place of Quarantine:</label> <br>
                    <label class="checkbox-inline"><input type="checkbox" value="@if($patient->covidassess)@if($patient->covidassess->place_quarantine == 1)1 @else 0 @endif @endif" name="place_quarantine" class="checkbox" @if($patient->covidassess)@if($patient->covidassess->place_quarantine == 1)checked @endif @endif>Home</label>
                    <div class="form-group">
                        <label>Quarantince Facility:</label>
                        <input type="text" class="form-control" value="@if($patient->covidassess){{ $patient->covidassess->quarantine_facility }} @endif" name="quarantine_facility">
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Fever(°C):</label>
                        <input type="text" class="form-control" value="@if($patient->covidassess){{ $patient->covidassess->fever }} @endif" name="fever">
                    </div>
                </div>
                <div class="col-md-3">
                    <br>
                    <label class="checkbox-inline"><input type="checkbox" value="@if($patient->covidassess)@if($patient->covidassess->cough == 1)1 @else 0 @endif @endif" name="cough" class="checkbox" @if($patient->covidassess)@if($patient->covidassess->cough == 1)checked @endif @endif>Cough</label>
                </div>
                <div class="col-md-3">
                    <br>
                    <label class="checkbox-inline"><input type="checkbox" value="@if($patient->covidassess)@if($patient->covidassess->colds == 1)1 @else 0 @endif @endif" name="colds" class="checkbox" @if($patient->covidassess)@if($patient->covidassess->colds == 1)checked @endif @endif>Colds</label>
                </div>
                <div class="col-md-3">
                    <br>
                    <label class="checkbox-inline"><input type="checkbox" value="@if($patient->covidassess)@if($patient->covidassess->sore_throat == 1)1 @else 0 @endif @endif" name="sore_throat" class="checkbox" @if($patient->covidassess)@if($patient->covidassess->sore_throat == 1)checked @endif @endif>Sore Throat</label>
                </div>
                <div class="col-md-12"><hr></div>
                 <div class="col-md-4">
                    <br>
                    <label class="checkbox-inline"><input type="checkbox" value="@if($patient->covidassess)@if($patient->covidassess->diarrhea == 1)1 @else 0 @endif @endif" name="diarrhea" class="checkbox" @if($patient->covidassess)@if($patient->covidassess->diarrhea == 1)checked @endif @endif>Diarrhea</label>
                </div>
                <div class="col-md-4">
                    <br>
                    <label class="checkbox-inline"><input type="checkbox" value="@if($patient->covidassess)@if($patient->covidassess->short_breathing == 1)1 @else 0 @endif @endif" name="short_breathing" class="checkbox" @if($patient->covidassess)@if($patient->covidassess->short_breathing == 1)checked @endif @endif>Shortness/Difficulty of breathing</label>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Other Symptoms Specify:</label>
                        <input type="text" class="form-control" value="@if($patient->covidassess){{ $patient->covidassess->other_symptoms }} @endif" name="other_symptoms">
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-4">
                     <div class="form-group">
                        <label>Is there any history of other illness?:</label>&nbsp;
                        <label class="radio-inline"><input type="radio" name="history_illness" value="1" required @if($patient->covidassess)@if($patient->covidassess->history_illness == 1)checked @endif @endif>Yes</label>
                        <label class="radio-inline"><input type="radio" name="history_illness" value="0"  @if($patient->covidassess)@if($patient->covidassess->history_illness == 0)checked @endif @endif>No</label>
                    </div>
                    <div class="formHi form-group hide">
                        <label>Specify:</label>
                        <input type="text" class="form-control" value="@if($patient->covidassess){{ $patient->covidassess->history_specify }} @endif" name="history_specify">
                    </div>
                </div>
                <div class="col-md-4">
                     <div class="form-group">
                        <label>Chest Xray Done?:</label>&nbsp;
                        <label class="radio-inline"><input type="radio" name="xray" value="1" required @if($patient->covidassess)@if($patient->covidassess->xray == 1)checked @endif @endif>Yes</label>
                        <label class="radio-inline"><input type="radio" name="xray" value="0"  @if($patient->covidassess)@if($patient->covidassess->xray == 0)checked @endif @endif>No</label>
                    </div>
                    <div class="formX form-group hide">
                        <label>When?:</label>
                        <input type="text" class="form-control daterange" value="{{ $xray_date }}" name="xray_date">
                    </div>
                </div>
                <div class="col-md-4">
                     <div class="form-group">
                        <label>Are you pregnant?:</label>&nbsp;
                        <label class="radio-inline"><input type="radio" name="pregnant" value="1" required @if($patient->covidassess)@if($patient->covidassess->pregnant == 1)checked @endif @endif>Yes</label>
                        <label class="radio-inline"><input type="radio" name="pregnant" value="0"  @if($patient->covidassess)@if($patient->covidassess->pregnant == 0)checked @endif @endif>No</label>
                    </div>
                    <div class="formlmp form-group hide">
                        <label>LMP:</label>
                        <input type="text" class="form-control" value="@if($patient->covidassess){{ $patient->covidassess->lmp }} @endif" name="lmp">
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="col-md-4">
                     <div class="form-group">
                        <label>CXR Results:</label>&nbsp;
                        <label class="radio-inline"><input type="radio" name="cxr_result" value="1" required @if($patient->covidassess)@if($patient->covidassess->cxr_result == 1)checked @endif @endif>Yes</label>
                        <label class="radio-inline"><input type="radio" name="cxr_result" value="0"  @if($patient->covidassess)@if($patient->covidassess->cxr_result == 0)checked @endif @endif>No</label>
                        <label class="radio-inline"><input type="radio" name="cxr_result" value="2"  @if($patient->covidassess)@if($patient->covidassess->cxr_result == 2)checked @endif @endif>Pending</label>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Other Radiologic Findings:</label>
                        <input type="text" class="form-control" value="@if($patient->covidassess){{ $patient->covidassess->radiologic_findings }} @endif" name="radiologic_findings">
                    </div>
                </div>
            </div>
        </div>
        <div class="box-header with-border" style="background-color: #00a65a; color: white;">
            <h4 style="">Specimen Information</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Specimen Collected:</label>
                        <input type="text" class="form-control" value="@if($patient->covidassess){{ $patient->covidassess->specimen_collected }} @endif" name="specimen_collected">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date Collected:</label>
                        <input type="text" class="form-control daterange" value="{{ $date_collected }}" name="date_collected">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date Sent to RITM or any accredited laboratory:</label>
                        <input type="text" class="form-control daterange" value="{{ $date_collected }}" name="date_collected">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date Received in RITM:</label>
                        <input type="text" class="form-control daterange" value="{{ $date_received_ritm }}" name="date_received_ritm">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Virus Isolation Result:</label>
                        <input type="text" class="form-control" value="@if($patient->covidassess){{ $patient->covidassess->virus_isolation_result }} @endif" name="virus_isolation_result">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>RT-PCR Result:</label>
                        <input type="text" class="form-control" value="@if($patient->covidassess){{ $patient->covidassess->rt_pcr_result }} @endif" name="rt_pcr_result">
                    </div>
                </div>
                <div class="col-md-12"><hr></div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Scrum</label>
                        <button type="button" class="btnAddrowScrum btn btn-success">Add row</button>
                    </div>
                    <div id="scrumRow">
                        @if(count($scrum) > 0)
                        @foreach($scrum as $s)
                        <div class="inputRow col-md-3">
                            <div class="inputRows form-group">
                                <input type="text" name="scrum[]" class="form-control" placeholder="___/___/____" value="{{ $s }}">
                                <div class="input-group-btn">
                                  <button class="btnRemoveRow btn btn-danger" type="button">Remove</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif  
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label>Oropharyngeal/Nasopharyngeal Swab</label>
                        <button type="button" class="btnAddrowSwab btn btn-success">Add row</button>
                    </div>
                    <div id="swabRow">
                        @if(count($oro_naso_swab) > 0)
                        @foreach($oro_naso_swab as $s)
                        <div class="inputRow col-md-3">
                            <div class="inputRows form-group">
                                <input type="text" name="oro_naso_swab[]" class="form-control" placeholder="___/___/____" value="{{ $s }}">
                                <div class="input-group-btn">
                                  <button class="btnRemoveRow btn btn-danger" type="button">Remove</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif  
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-3">
                        <label>Others</label>
                        <button type="button" class="btnAddrowother btn btn-success">Add row</button>
                    </div>
                    <div id="otherRow">
                        @if(count($spe_others) > 0)
                        @foreach($spe_others as $s)
                        <div class="inputRow col-md-3">
                            <div class="inputRows form-group">
                                <input type="text" name="spe_others[]" class="form-control" placeholder="___/___/____" value="{{ $s }}">
                                <div class="input-group-btn">
                                  <button class="btnRemoveRow btn btn-danger" type="button">Remove</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif  
                    </div>
                </div>
            </div>
        </div>
        <div class="box-header with-border" style="background-color: #00a65a; color: white;">
            <h4 style="">Classification</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                     <div class="form-group">
                        <label class="radio-inline"><input type="radio" name="classification" value="1" required @if($patient->covidassess)@if($patient->covidassess->classification == 1)checked @endif @endif>Suspect Case</label>
                        <label class="radio-inline"><input type="radio" name="classification" value="0"  @if($patient->covidassess)@if($patient->covidassess->classification == 0)checked @endif @endif>Probable Case</label>
                        <label class="radio-inline"><input type="radio" name="classification" value="2"  @if($patient->covidassess)@if($patient->covidassess->classification == 2)checked @endif @endif>Confirmed Case</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-header with-border" style="background-color: #00a65a; color: white;">
            <h4 style="">Outcome</h4>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Date of Discharge:</label>
                        <input type="text" class="form-control daterange" value="{{ $outcome_date_discharge }}" name="outcome_date_discharge">
                    </div>
                </div>
                <div class="col-md-6">
                     <div class="form-group">
                        <label>Condition on Discharge</label>
                        <label class="radio-inline"><input type="radio" name="outcome_condition_discharge" value="1" required @if($patient->covidassess)@if($patient->covidassess->outcome_condition_discharge == 1)checked @endif @endif>Died</label>
                        <label class="radio-inline"><input type="radio" name="outcome_condition_discharge" value="0"  @if($patient->covidassess)@if($patient->covidassess->outcome_condition_discharge == 0)checked @endif @endif>Improved</label>
                        <label class="radio-inline"><input type="radio" name="outcome_condition_discharge" value="2"  @if($patient->covidassess)@if($patient->covidassess->outcome_condition_discharge == 2)checked @endif @endif>Recovered</label>
                        <label class="radio-inline"><input type="radio" name="outcome_condition_discharge" value="3"  @if($patient->covidassess)@if($patient->covidassess->outcome_condition_discharge == 3)checked @endif @endif>Transferred</label>
                        <label class="radio-inline"><input type="radio" name="outcome_condition_discharge" value="4"  @if($patient->covidassess)@if($patient->covidassess->outcome_condition_discharge == 4)checked @endif @endif>Absconded</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>