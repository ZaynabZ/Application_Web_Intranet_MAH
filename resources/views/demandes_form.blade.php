@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Demande de Document</h4>
                  <p class="card-description">De quel document avez vous besoin?</p>
                  <form action="{{ route('demandes') }}" method="POST">
                      @csrf
                    <div class="row">                      
                      <div class="col-md-8">
                        <div class="form-group">
                            @foreach($demandes as $demande)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" 
                                    name="demande_id" id="demande_id" value="{{ $demande->id }}">
                                    {{ $demande->type_demande }}
                                </label>
                            </div> 
                            @endforeach
                                                   
                        </div>
                      </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary mr-2">Envoyer</button>
                            <a href="{{ route('home') }}" class="btn btn-light">Annuler</a>
                        </div>
                        
                    </div>
                  </form>
            </div>
                
        </div>
    </div>
    <div class="col-md-3"></div>
</div>

<div class="row">
    
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Mes Demandes</h4>
          <h6>Nombre d'éléments trouvés: {{ count($user_demandes) }}</h6>
          <div class="table-responsive" style="overflow: hidden;">
              <table class="table table-striped" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                            <tr>                             
                              <th>Date demande</th>
                              <th>Type</th>                              
                              <th>Etat</th>                              
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($user_demandes as $user_demande)
                            <tr>
                              
                              <td>{{ $user_demande->pivot->created_at->format('j F, Y') }}</td>
                              
                              
                              
                             
                              <td>{{ $user_demande->type_demande }}</td>
                                
                                   
                                                       
                                <td>{{ $user_demande->pivot->etat }}</td>
                                                   
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
  </div>

              
</div>

@endsection