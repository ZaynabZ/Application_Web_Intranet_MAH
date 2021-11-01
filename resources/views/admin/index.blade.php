@extends('layouts.app')

@section('content')
<div class="row">
    
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Liste des Utilisateurs</h4>
          <div class="table-responsive" style="overflow: hidden;">
              <table class="table table-striped" width="100%" cellspacing="0" cellpadding="0">
                <thead>
                            <tr>
                              <th>Matricule</th>
                              <th>Nom Complet</th>
                              <th>Email</th>
                              
                              <th>Rôle</th>
                              <th>Service</th>
                              <th></th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($users as $user)
                            <tr>
                              <td>{{ $user->matricule ?? '***'}}</td>
                              <td class="py-1">
                                {{ $user->first_name }} {{ $user->last_name }}
                              </td>
                             
                              <td>{{ $user->email }}</td>
                                
                                   
                                                       
                                <td>{{ $user->role->role_name }}</td>
                                <td>
                                      {{ $user->service->name ?? '***' }}
                                </td>     
                              <td >
                                  <div class="btn-toolbar" role="group">
                                    <a href="{{ url('/edit_user')}}/{{$user->id}}" class="btn btn-success btn-sm mr-2"><i class="mdi mdi-lead-pencil"></i></a>
                                  <form action="{{ url('/delete_user') }}/{{$user->id}}" method="POST"> 
                                    @csrf
                                    <button class="btn btn-danger btn-sm ml-2" type="submit"><i class="mdi mdi-delete"></i></button>
                                    </form>     
                                  </div>
                              </td>                         
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