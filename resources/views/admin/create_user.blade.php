@extends('layouts.app')

@section('content')

<div class="col-md-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ __("Ajouter un nouveau utilisateur") }}</h4>
            <form  method="POST" action="{{ route('create_user') }}" class="form-sample">
            @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ __('Prénom') }}</label>
                                <div class="col-sm-9">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="off" autofocus />
                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ __('Nom') }}</label>
                                <div class="col-sm-9">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                                    name="last_name" value="{{ old('last_name') }}"
                                                    autocomplete="off" 
                                                    required autofocus />
                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ __('Username') }}</label>
                                <div class="col-sm-9">
                                    <input id="username" type="text" autocomplete="off" class="form-control @error('username') is-invalid @enderror" 
                                                name="username" value="{{ old('username') }}"
                                                autocomplete="off" 
                                                required autofocus />
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                              
                                </div>
                            </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">{{ __('E-Mail') }}</label>
                            <div class="col-sm-9">
                                <input id="email" type="email" name="email" value="{{ old('email') }}" 
                                      class="form-control @error('email') is-invalid @enderror" 
                                      required autocomplete="off" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror   
                            </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">{{ __('Service') }}</label>
                          <div class="col-sm-9">
                            <select id="services" name="service_id" class="form-control @error('service_id') is-invalid @enderror">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach                              
                            </select>
                            @error('service_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">{{ __('Role') }}</label>
                          <div class="col-sm-9">
                            <select id="roles" name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                                @endforeach                              
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                          </div>
                        </div>
                      </div>
                      
                    </div>
                    <div class="row">

                      <div class="col-md-6">
                              <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">{{ __('Matricule') }}</label>
                                  <div class="col-sm-9">
                                      <input id="matricule" name="matricule" type="text" class="form-control @error('matricule') is-invalid @enderror" value="{{ old('matricule') }}" required autocomplete="off" autofocus />
                                      @error('matricule')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>
                      </div>

                      <div class="col-md-6">
                              <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">{{ __('Solde') }}</label>
                                  <div class="col-sm-9">
                                      <input id="solde" type="text" class="form-control @error('solde') is-invalid @enderror" name="solde" value="{{ old('solde') }}" required autocomplete="off" autofocus />
                                      @error('solde')
                                          <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                      @enderror
                                  </div>
                              </div>
                      </div>
                      
                      
                      
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                            <label class="col-sm-3 col-form-label"  style="padding-top:10px">{{ __('Sexe') }}</label>
                            <div class="col-sm-4">
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" id="gender_f" value="F" checked>
                                    {{ __('Féminin') }}
                                </label>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="gender" id="gender_m" value="M">
                                    {{ __('Masculin') }}
                                </label>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="padding-top: 0px;">Date d'embauche</label>
                                <div class="col-sm-9">
                                    <input id="date_embauche" type="date" class="form-control @error('date_embauche') is-invalid @enderror" name="date_embauche" value="{{ old('date_embauche') }}" required autocomplete="off" autofocus />
                                    @error('date_embauche')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                          <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">{{ __('Mot de Passe') }}</label>
                                <div class="col-sm-9">
                                    <input id="password" type="password" name="password" 
                                           class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" />

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                          </div>
                          <div class="col-md-6">
                              <div class="form-group row">
                                <label class="col-sm-3 col-form-label" style="padding-top: 0px;">{{ __('Confirmer le Mot de Passe') }}</label>
                                <div class="col-sm-9">
                                    <input id="password-confirm" type="password" 
                                    class="form-control" name="password_confirmation" 
                                    required autocomplete="new-password">
                                </div>
                              </div>
                          </div>
                    </div>
                     
                    <div class="row">                     
                        <div class="col-md-6">                                
                            <button type="submit" class="btn btn-primary">
                                {{ __('Enregistrer') }}
                            </button>    
                        </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
@endsection
