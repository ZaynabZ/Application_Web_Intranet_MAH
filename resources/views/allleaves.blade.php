@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-1 grid-margin "></div>
<div class="col-lg-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des conges</h4>
                 @if (count($leaves) > 0)
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                        <th>
                            full name
                          </th>
                          <th>
                            service
                          </th>
                          <th>
                            date_debut
                          </th>
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
                          <th>
                          {{ $l->date_debut}}
                          </th>
                          <th>
                          {{ $l->date_fin }}
                          </th>
                          <th>
                          {{ $l->justification }}
                          </th>
                          <th>
                          {{ $l->etat }}
                          </th>
                          <td >
                              <div class="btn-toolbar" role="group">
                               <form action="{{route('leave.delete',$l->id)}}" method="POST"> 
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

                  @endif

                </div>
              </div>
            </div>

            <div class="col-lg-1 grid-margin "></div>
</div>

@endsection