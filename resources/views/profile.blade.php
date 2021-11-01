@extends('layouts.app')

@section('content')
<div class="row">
  @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <button type="button" class="close" data-dismiss="alert">×</button>
      <strong>{{ $message }}</strong>
    </div>
  @endif
</div>
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Profile</h4>
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Nom Complet</th>
                <th>{{ $user->first_name}} {{ $user->last_name }}</th>
              </tr>
              <tr>
                <th>Nom d'utilisateur</th>
                <th>{{ $user->username }}</th>
              </tr>                      
              <tr>
                <th>Email</th>
                <th>{{ $user->email }}</th>                          
              </tr>
              <tr>
                <th>Sexe</th>
                @if($user->gender == 'F')
                  <th>Féminin</th>
                @else
                  <th>Masculin</th>
                @endif  
              </tr>
              <tr>
                <th>Role</th>
                  <th>{{$m}}</th>
              </tr>
              <tr>
                <th>Service</th>
                <th>Undefined</th>
              </tr>
            </table>
          </div>
      </div>
    </div>
  <div class="col-lg-2"></div>
</div>


<div class="row mb-4">
  <div class="col-md-12">
    @if (Route::has('password.request'))
      <a class="btn btn-primary font-weight-medium auth-form-btn" href="{{ route('password.request') }}">Réinitialiser le mot de passe</a>
    @endif
  </div>
  
</div>


@endsection

