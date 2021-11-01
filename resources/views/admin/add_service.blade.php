@extends('layouts.app')

@section('content')

<div class="col-md-12 grid-margin">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Ajouter un Service</h4>
            <form action="{{ route('add_service') }}" class="forms-sample" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Service</label>                            
                            <div class="col-sm-9">
                                <input autocomplete="off" name="name" type="text" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        placeholder="Nom du Service" aria-label="Label">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
            </form>
                
        </div>  
    </div>
</div>

@endsection
        