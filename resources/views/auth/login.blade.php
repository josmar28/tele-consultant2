@extends('layouts.login')

@section('content')
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <img src="{{ asset('public/img/Doctor_Online_Consultation.png') }}" alt="Image" class="img-fluid">
      </div>
      <div class="col-md-6 contents">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="mb-4 text-center">
              <span> <img src="{{ asset('public/img/doh.png') }}" style="width: 25%"/>&nbsp;
              <img src="{{ asset('public/img/dohro12logo2.png') }}" style="width: 25%"/>
            </div>
            <div class="mb-4 text-center">
              <span class="text-muted">DOH-CHD XII SOCCSKSARGEN TELECONSULTATION</span>
              <span class="d-block text-center my-4 text-muted">&mdash; Created by: DOH Region XII &mdash;</span>
            </div>
            <div class="text-center">
              <label>LOGIN</label>
            </div>
          <span class="help-block">
              @if($errors->any())
                  <strong style="color: #A52A2A;">{{$errors->first()}}</strong>
              @endif
          </span>
          <form method="POST" action="{{ asset('login') }}">
            {{ csrf_field() }}
            <div class="form-group first">
              <label for="username">Username</label>
              <input autofocus type="text" class="form-control" id="username" name="username" autocomplete="off">
            </div>
            <div class="form-group last mb-4">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password" name="password">
              
            </div>
            <button type="submit" class="btn-submit btn btn-block btn-success">LOGIN</button>
            <a href="{{ asset('register') }}" style="text-decoration: none;"><button type="button" class="btn btn-block btn-info mt-3">REGISTER AS PATIENT</button></a>
          </form>
          </div>
        </div>
        
      </div>
      
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
  $('.btn-submit').on('click',function(){
      $(this).html('<i class="fa fa-spinner fa-spin"></i> Validating...');

  });
</script>
@endsection