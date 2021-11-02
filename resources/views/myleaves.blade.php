@extends('layouts.app')

@section('content')

<div class="row">
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des conges</h4>
                 @if (count($leaves) > 0)

                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>
                                motif
                              </th>
                              <th>
                                date_debut
                              </th>
                              <th>
                                date_fin
                              </th>
                              <th>
                                justification
                              </th>
                              @if(Auth::user()->isSuperAdmin() || Auth::user()->isSupervisor() )
                                <th>
                                  Nom complet
                                </th>
                                <th>
                                  service
                                </th>
                              @endif
                              <th>
                                Etat
                              </th>
                              <th>
                                Actions
                              </th>                         
                            </tr>
                          </thead>
                          <tbody>
                            @foreach(  $leaves as $l)
                            <tr>
                              <td class="py-1">
                                {{ $l->motif }}
                              </td>
                              <td class="py-1">
                              {{ $l->date_debut}}
                              </td>
                              <td class="py-1">
                              {{ $l->date_fin }}
                              </td>
                              <td class="py-1">
                              {{ $l->justification }}
                              </td>
                              @if(Auth::user()->isSuperAdmin() || Auth::user()->isSupervisor() )
                              <td class="py-1">
                                {{ $l->users->first_name }}
                                  </td>
                                <td class="py-1">
                                {{ $l->users->service->name}}

                                </td>
                              @endif
                              <td class="py-1">
                              {{ $l->etat }}
                              </th>
                              <td class="py-1">
                                  <div class="btn-toolbar" role="group">

                                  @if(Auth::user()->isUser())
                                  <form action="{{route('leave.delete',$l->id)}}" method="POST"> 
                                    @csrf
                                    <button class="btn btn-danger btn-sm ml-2" type="submit"><i class="mdi mdi-delete"></i></button>
                                    </form>
                                  @endif

                                  @if(Auth::user()->isSuperAdmin())

                                    <form action="{{route('leave.decision',['id'=> $l->id , 'd'=> 0 ,'user_id' => $l->user_id ])}}" method="POST"> 
                                    @csrf
                                    <button class="btn btn-danger btn-sm ml-2" type="submit" style="margin:1rem;">reject</button>
                                    </form>   
                                    <form action="{{route('leave.decision',['id'=>  $l->id , 'd'=> 1 ,'user_id' => $l->user_id ])}}" method="POST"> 
                                    @csrf
                                    <button class="btn btn-success btn-sm ml-2" type="submit" style="margin:1rem;" >accept</button>
                                    </form>   

                                  @endif
                            
                                  </div>
                              </td>                         
                            </tr>
                            @endforeach
                          </tbody>
                        </table>
                      </div>

                  @endif

                </div>
              </div>
</div>

      
</div>

@endsection
