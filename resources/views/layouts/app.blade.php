<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>MyOpla Intranet Application</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">

  <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
  <!-- <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}"> -->
  <link rel="stylesheet" type="{{ asset('assets/text/css" href="js/select.dataTables.min.css') }}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />

  <style>
    .footer {
      bottom:0;
      width:100%;
    }
  </style>
  @yield("style")
</head>
<body>
  @auth
  <div class="container-scroller">
   
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo_myopla.png') }}" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        <ul class="navbar-nav navbar-nav-right">
          
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              @if(Auth::user()->gender == 'F')
                <img src="{{ asset('assets/images/faces/female_profile.jpg') }}" alt="profile"/>
              @else
                <img src="{{ asset('assets/images/faces/male_profile.png') }}" alt="profile"/>  
              @endif
              
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="{{ route('profile')}}">
                <i class="ti-settings text-primary"></i>
                {{ @Auth::user()->username }}
              </a>
              <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                <form  method="POST" action="{{ route('logout')}}">
                  @csrf
                  <button class="btn btn-sm btn-primary" type="submit">Logout</button>
                </form>
                
              </a>
            </div>
          </li>

          
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
                <i class="icon-bell mx-0"></i>
                <span> {{ @Auth::user()->unreadNotifications->count() }}</span>               
              </a>

              @unless(@Auth::user()->unreadNotifications->isEmpty())

              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                    @foreach(@Auth::user()->unreadNotifications as $n)
                        @if($n->type == 'App\Notifications\NewDocumentPosted')
                            @if($n->data['type'] == 'pdf')
                            <a class="dropdown-item preview-item" href="{{ route('pfile',['namefile'=> $n->data['filename'],'notification' => $n->id]) }}">
                            @else
                            <a class="dropdown-item preview-item" href="{{ route('ifile',['namefile'=> $n->data['filename'],'notification' => $n->id]) }}">
                            @endif
                              <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                  <i class="ti-info-alt mx-0"></i>
                                </div>
                              </div>
                                <div class="preview-item-content">
                                  
                                    <p class="preview-subject font-weight-normal"> {{ $n->data['first'] }} {{ $n->data['last']}} a posté un document {{ $n->data['type']}}  </p>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                    {{ $n->data['date'] }}
                                    </p>
                                  </div>
                            </a>
                            <!--   -->
                      @endif
                      @if($n->type == 'App\Notifications\responseLeaveNotification')
                            <a class="dropdown-item preview-item" href="{{route('myleaves',['id'=> @Auth::user()->id,'nf'=> $n ])}}">
                              <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                  <i class="ti-info-alt mx-0"></i>
                                </div>
                              </div>
                                <div class="preview-item-content">
                                  
                                    <p class="preview-subject font-weight-normal">il y'a des nouvelles a propos votre demande de conge .</p>
                                    <p class="font-weight-light small-text mb-0 text-muted">
                                    {{ $n->data['date'] }}
                                    </p>
                                  </div>
                            </a>
                      @endif
                          @if($n->type == 'App\Notifications\PostLeaveNotification')
                                  <a class="dropdown-item preview-item" href="{{route('leaves',$n)}}">
                                    <div class="preview-thumbnail">
                                      <div class="preview-icon bg-success">
                                        <i class="ti-info-alt mx-0"></i>
                                      </div>
                                    </div>
                                      <div class="preview-item-content">
                                        
                                          <p class="preview-subject font-weight-normal"> {{ $n->data['first'] }} {{ $n->data['last']}} a demandé un conge .</p>
                                          <p class="font-weight-light small-text mb-0 text-muted">
                                          {{ $n->data['date'] }}
                                          </p>
                                        </div>
                                  </a>
                            @endif
                      
                      @if($n->type == 'App\Notifications\StatusDemandesNotification')
                          <a class="dropdown-item preview-item" href="{{ route('demandes', $n) }}">  
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-success">
                                <i class="ti-info-alt mx-0"></i>
                              </div>
                            </div>
                            <div class="preview-item-content">
                              
                              <p class="preview-subject font-weight-normal">{{ $n->data['demande'] }}</p>
                              <p class="font-weight-light small-text mb-0 text-muted">{{ $n->data['notification_time'] }}
                                    
                              </p>
                            </div>
                          </a>
                        @elseif($n->type == 'App\Notifications\DemandesNotification')
                          <a class="dropdown-item preview-item" href="{{ route('superadmin_demandes', $n) }}">  
                              <div class="preview-thumbnail">
                                <div class="preview-icon bg-success">
                                  <i class="ti-info-alt mx-0"></i>
                                </div>
                              </div>
                              <div class="preview-item-content">
                                <p class="preview-subject font-weight-normal">{{ $n->data['type_demande'] }}</p>
                                <p class="preview-subject font-weight-normal">Demande effectuée par: {{ $n->data['last_name'] }} {{ $n->data['first_name'] }}</p>
                                <p class="font-weight-light small-text mb-0 text-muted">{{ $n->data['notification_time'] }}</p>
                              </div>
                            </a>  
                        @endif
                @endforeach

              </div>
            </li>
          @endunless         
        </ul>

        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">

          <li class="nav-item">
            <a class="nav-link" href="{{ route('profile') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Profile</span>
            </a>
           
          </li>

          @if(Auth::user()->isAdmin() || Auth::user()->isSuperAdmin())                     
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Services</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('services') }}">Liste</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('add_service') }}">Ajouter Service</a></li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
              <i class="icon-head menu-icon"></i>
                <span class="menu-title">Utilisateurs</span>
                <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="users">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="{{ route('users') }}">Liste</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('create_user') }}">Ajouter Utilisateur</a></li>
                </ul>
              </div>
            </li>
          @endif

             
          <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#conges" aria-expanded="false" aria-controls="conges">
                  <i class="icon-head menu-icon"></i>
                    <span class="menu-title">Congés</span>
                  <i class="menu-arrow"></i>
              </a>
              <div class="collapse" id="conges">
                <ul class="nav flex-column sub-menu">
                @if(! Auth::user()->isSuperAdmin() )    
                  <li class="nav-item"> <a class="nav-link" href="{{ route('leave') }}">Effecter Demande</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{ route('myleaves',Auth::user()->id) }}">Mes demandes</a></li>
                @elseif(Auth::user()->isSuperAdmin() || Auth::user()->isSupervisor())
                  <li class="nav-item"> <a class="nav-link" href="{{ route('leaves') }}">Demandes</a></li>
                @else()
                @endif
                </ul>
              </div>
          </li>

            @if(! Auth::user()->isSuperAdmin())    
          <li class="nav-item">
            <a class="nav-link" href="{{ route('demandes') }}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Demandes</span>
            </a>
          </li>
          @endif

          
          <li class="nav-item">
            <a class="nav-link" href="{{ route('file.showfiles') }}">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Documents</span>
            </a>
          </li>

          @if(!(Auth::user()->isUser()))
            <li class="nav-item">
              <a class="nav-link" href="{{ route('CV_upload') }}">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Candidats</span>
              </a>
            </li>
          @endif
          
          <li class="nav-item">
          <a class="nav-link" data-toggle="collapse" href="#gym" aria-expanded="false" aria-controls="gym">          
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Myopla Gym</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="gym">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('gym') }}">Gym reservations</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('myreservations') }}">Mes reservations</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Application Intranet MyOpla.</span>
            
          </div>
          <div class="d-sm-flex justify-content-center justify-content-sm-between mt-3">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"><img src="{{ asset('assets/images/favicon.ico') }}" /></span> 
          </div>
        </footer> 
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>   
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

   <!-- plugins:js -->
   <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script> -->
  <script src="{{ asset('assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('assets/js/dataTables.select.min.js') }}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <!-- <script src="{{ asset('assets/js/off-canvas.js') }}"></script> -->
  <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('assets/js/template.js') }}"></script>
  <script src="{{ asset('assets/js/settings.js') }}"></script>
  <script src="{{ asset('assets/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('assets/js/dashboard.js') }}"></script>
  <!-- <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script> -->

    @yield("javascript")

  <!-- End custom js for this page-->
  @endauth

</body>

</html>

