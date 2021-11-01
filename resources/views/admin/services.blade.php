@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-1 grid-margin "></div>
<div class="col-lg-10 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Liste des Services</h4>
                 
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Service
                          </th>
                          <th>
                            Actions
                          </th>
                          
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($services as $service)
                        <tr>
                          <td class="py-1">
                            {{ $service->name }}
                          </td>
                          <td class="py-1" >
                              <div class="btn-toolbar" role="group">
                                 <a href="{{ url('/edit_service')}}/{{$service->id}}" class="btn btn-success btn-sm mr-2"><i class="mdi mdi-lead-pencil"></i></a>
                               <form action="{{ url('/delete_service') }}/{{$service->id}}" method="POST"> 
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

            <div class="col-lg-1 grid-margin "></div>
</div>

@endsection