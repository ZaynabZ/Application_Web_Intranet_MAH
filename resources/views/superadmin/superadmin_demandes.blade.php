@extends('layouts.app')

@section('content')

<div class="row">
    
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Les Demandes</h4>
          <h6>Nombre d'éléments trouvés: {{ count($demandes) }}</h6>
          <div class="table-responsive" style="overflow: hidden;">
              <table class="table table-striped" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                            <tr> 
                              <th>Date demande</th>
                              <th>Type</th>                              
                              <th></th>                              
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($demandes as $demande)
                            <tr>                              
                              <td>{{ $demande->pivot->created_at->format('j F, Y') }}</td> 
                              <td>{{ $demande->type_demande }}</td>
                              <td>
                                <form action="{{ url('/demande_realisee') }}/{{ $demande->id }}/{{ $demande->pivot->user_id }}" method="POST"> 
                                        @csrf
                                        <input hidden value="{{ $demande->pivot->id }}" name="id" />
                                        <button class="btn btn-primary btn-sm ml-2" type="submit">Marquer comme réalisée</button>
                                        </form> 
                                </td> 
                              
                              
                              
                                    
                                        
                                  </div>
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