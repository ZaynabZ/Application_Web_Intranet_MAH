@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-3 grid-margin"></div>
    <div class="col-md-6 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Demande de documents</h4>
                <p class="card-description">De quel document avez-vous besoin?</p>
                    <form>
                        @csrf
                        <div class="row">                        
                            <div class="col-md-12">
                                <div class="form-group">
                                    @foreach($demandes as $demande)
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" 
                                                name="optionsRadios" id="optionsRadios1" value="{{ $demande->id }}">
                                                {{ $demande->type_demande }}
                                            </label>
                                        </div>  
                                    @endforeach                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">                     
                            <div class="col-md-8">                                
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enregistrer') }}
                                </button>  
                                <a class="btn btn-outline-secondary" href="{{ route('home') }}">
                                    {{ __('Annuler') }}
                                </a>  
                            </div>
                                               
                        </div>
                    </form>
                    </div>
                    
                </div>
                </div>
                
                <div class="col-md-3 grid-margin"></div>
            </div>


@endsection