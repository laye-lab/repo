
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SenAdmin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="../plugins/fullcalendar/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-daygrid/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-timegrid/main.min.css">
  <link rel="stylesheet" href="../plugins/fullcalendar-bootstrap/main.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>

        </li>

        <li  class="nav-item d-none d-sm-inline-block">
          <a  href="{{route('Acceuil')}}" class="nav-link">Acceuil</a>
        </li>

        <li class="nav-item d-none d-sm-inline-block">
          <a href="https://www.seneau.sn/portail/fr-FR" class="nav-link">Contact</a>
        </li>

      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="rechercher" disabled aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fas fa-search"></i>
            </button>
          </div>
        </div>
      </form>



  </ul>
<!-- Right Side Of Navbar -->
<ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
        </li>
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else

    <li class="nav-item dropdown">
      <div class="user-block">
        <img class="img-circle img-bordered-sm" src="{{asset('../../dist/img/icone2.png')}}" alt="user image">
  </div>
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          <span class="username">
          @foreach($role_account as $role)
          @if(Auth::user()->id == $role->Matricule_agent)
          {{$role->Nom_Agent}}
          @break
          @else
          @endif
          @endforeach
        </span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Se deconnecter') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

        </div>
    </li>
    @endguest

</ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index3.html" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">SenAdmin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
          <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">sen'Admin</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            @foreach($role_account as $role)
            @if(Auth::user()->id == $role->Matricule_agent)
            @switch($role->Nom)
            @case('n+1')
                                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                            <!-- Add icons to the links using the .nav-icon class
                                                with font-awesome or any other icon font library -->
                                                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                                                <div class="nav-link" style="color:white;">
                                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                                <p > Navigateur</p>
                                                </div>
                                                </div>
                                                <li class="nav-item has-treeview menu-open">
                                                    <a  href="{{route('Acceuil')}}" href="#" class="nav-link">
                                                        <i class="fas fa-home"></i>
                                                        <p>
                                                       Acceuil
                                                        </p>
                                                    </a>
                                                </li>

                                        <li class="nav-item has-treeview menu-open">
                                        <a  href="{{route('homeSaisie')}}" class="nav-link">
                                            <i class="nav-icon fas fa-pen-alt"></i>
                                            <p>
                                            Saisie heure
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                    <a  class="nav-link">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <i class="nav-icon fas fa-user-check"></i>
                                        <p>Choix collaborateur</p>
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                    <a  class="nav-link">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <i class="nav-icon far fa-calendar-check"></i>
                                        <p>Saisie  </p>
                                    </a>
                                    </li>
                                    <li class="nav-item has-treeview menu-open">
                                    <a href="{{route('Validation')}}" class="nav-link">
                                        <i class="nav-icon fas fa-check-double"></i>
                                        <p>
                                        Valider heure
                                      <span class="badge badge-info right">new</span>
                                        </p>
                                    </a>
                                    </li>
                                    <li class="nav-item has-treeview menu-open">
                                    <a href="{{route('Validation')}}" class="nav-link">
                                        <i class="nav-icon fas fa-eye"></i>
                                        <p>
                                        Consulter agent
                                        </p>
                                    </a>
                                    </li>
                                        </ul>

                    @break
                    @case('sec')
                                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                            <!-- Add icons to the links using the .nav-icon class
                                                with font-awesome or any other icon font library -->
                                                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                                                <div class="nav-link" style="color:white;">
                                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                                <p > Navigateur</p>
                                                </div>
                                                </div>
                                                <li class="nav-item has-treeview menu-open">
                                                    <a  href="{{route('Acceuil')}}" href="#" class="nav-link">
                                                        <i class="fas fa-home"></i>
                                                        <p>
                                                       Acceuil
                                                        </p>
                                                    </a>
                                                </li>

                                        <li class="nav-item has-treeview menu-open">
                                        <a  href="{{route('homeSaisie')}}" class="nav-link">
                                            <i class="nav-icon fas fa-pen-alt"></i>
                                            <p>
                                            Saisie heure
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                    <a  class="nav-link">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <i class="nav-icon fas fa-user-check"></i>
                                        <p>Choix collaborateur</p>
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                    <a  class="nav-link">
                                        <i class="nav-icon far fa-circle text-info"></i>
                                        <i class="nav-icon far fa-calendar-check"></i>
                                        <p>Saisie  </p>
                                    </a>
                                    </li>
                                    <li class="nav-item has-treeview menu-open">
                                    <a href="{{route('Validation')}}" class="nav-link">
                                        <i class="nav-icon fas fa-check-double"></i>
                                        <p>
                                        Valider heure
                                      <span class="badge badge-info right">new</span>
                                        </p>
                                    </a>
                                    </li>
                                    <li class="nav-item has-treeview menu-open">
                                    <a href="{{route('Validation')}}" class="nav-link">
                                        <i class="nav-icon fas fa-eye"></i>
                                        <p>
                                        Consulter agent
                                        </p>
                                    </a>
                                    </li>
                                        </ul>

                    @break
                @case('n+2')
                                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                            <!-- Add icons to the links using the .nav-icon class
                                                with font-awesome or any other icon font library -->
                                                <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                                                <div class="nav-link" style="color:white;">
                                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                                <p > Navigateur</p>
                                                </div>
                                                </div>
                                                <li class="nav-item has-treeview menu-open">
                                                    <a  href="{{route('Acceuil')}}" href="#" class="nav-link">
                                                        <i class="fas fa-home"></i>
                                                        <p>
                                                    Acceuil
                                                        </p>
                                                    </a>
                                                </li>
                                                <li class="nav-item has-treeview menu-open">
                                                <a href="{{route('homeCommandeindex')}}" class="nav-link" >
                                                    <i class="nav-icon fas fa-user-plus"></i>
                                                    <p>
                                                    Commande heure

                                                    </p>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                            <a  class="nav-link">
                                                <i class="nav-icon fas fa-laptop-house"></i>
                                                <p class="text">Choix service</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a class="nav-link">

                                                <i class="nav-icon fas fa-user-check"></i>
                                                <p>Choix collaborateur</p>
                                            </a>
                                            </li>
                                            <li class="nav-item">
                                            <a  class="nav-link">
                                                <i class="nav-icon far fa-calendar-check"></i>
                                                <p>Saisie  </p>
                                            </a>
                                            </li>


                                        <li class="nav-item has-treeview menu-open">
                                        <a href="{{route('homeSaisie')}}"   class="nav-link">
                                            <i class="nav-icon fas fa-pen-alt"></i>
                                            <p>
                                            Saisie heure
                                            </p>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon fas fa-user-check"></i>
                                        <p>Choix collaborateur</p>
                                    </a>
                                    </li>
                                    <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon far fa-calendar-check"></i>
                                        <p>Saisie  </p>
                                    </a>
                                    </li>
                                    <li class="nav-item has-treeview menu-open">
                                    <a  href="{{route('Validation')}}" class="nav-link">
                                        <i class="nav-icon fas fa-check-double"></i>
                                        <p>
                                        Valider heure
                                        <span class="badge badge-info right">new</span>
                                        </p>
                                    </a>
                                    </li>
                                    <li class="nav-item has-treeview menu-open">
                                    <a  href="{{route('Validation')}}"class="nav-link">
                                        <i class="nav-icon fas fa-eye"></i>
                                        <p>
                                        Consulter agent
                                        </p>
                                    </a>
                                    </li>
                                        </ul>
                            @break
                 @case('n+3')
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                        <!-- Add icons to the links using the .nav-icon class
                                            with font-awesome or any other icon font library -->
                                            <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                                            <div class="nav-link" style="color:white;">
                                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                            <p > Navigateur</p>
                                            </div>
                                            </div>
                                            <li class="nav-item has-treeview menu-open">
                                                <a  href="{{route('Acceuil')}}" href="#" class="nav-link">
                                                    <i class="fas fa-home"></i>
                                                    <p>
                                                   Acceuil
                                                    </p>
                                                </a>
                                            </li>

                                            <li class="nav-item has-treeview menu-open">
                                            <a  href="{{route('Validation')}}" class="nav-link">
                                                <i class="nav-icon fas fa-check-double"></i>
                                                <p>
                                                Valider heure
                                              <span class="badge badge-info right">new</span>
                                                </p>
                                            </a>
                                            </li>
                                            <li class="nav-item has-treeview menu-open">
                                            <a href="{{route('Validation')}}" class="nav-link">
                                                <i class="nav-icon fas fa-eye"></i>
                                                <p>
                                                Consulter agent
                                                </p>
                                            </a>
                                            </li>
                                    </ul>

                    @break

                 @case('drh')
                 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                        <div class="nav-link" style="color:white;">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p > Navigateur</p>
                        </div>
                        </div>
                        <li class="nav-item has-treeview menu-open">
                            <a  href="{{route('Acceuil')}}" href="#" class="nav-link">
                                <i class="fas fa-home"></i>
                                <p>
                               Acceuil
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview menu-open">
                            <a  href="{{route('Chartsrh')}}" href="#" class="nav-link">
                                <i class="fas fa-chart-bar"></i>
                                <p>
                                    Statistiques
                                </p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview menu-open">
                        <a  href="{{route('Calculheure')}}" href="#" class="nav-link">
                            <i class="nav-icon fas fa-eye"></i>
                            <p>
                            Heure supplémentaire
                            </p>
                        </a>
                        </li>
                        <li class="nav-item has-treeview menu-open">
                            <a  href="{{route('Dashbord')}}" href="#" class="nav-link">
                                <i class="fas fa-route"></i>
                                                            <p>
                                Tableau de bord
                                </p>
                            </a>
                            </li>
                            <li class="nav-item has-treeview menu-open">
                                <a  href="{{route('Affectationindex')}}" href="#" class="nav-link">
                                    <i class="fas fa-luggage-cart"></i>
                                    <p>
                                    Affectation
                                    </p>
                                </a>
                             </li>
                </ul>

                    @break
                    @case('dto')
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                                    <div class="nav-link" style="color:white;">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p > Navigateur</p>
                                    </div>
                                    </div>
                                      <li class="nav-item has-treeview menu-open">
                                                <a  href="{{route('Acceuil')}}" href="#" class="nav-link">
                                                    <i class="fas fa-home"></i>
                                                    <p>
                                                   Acceuil
                                                    </p>
                                                </a>
                                            </li>

                                    <li class="nav-item has-treeview menu-open">
                                    <a  href="{{route('Validation')}}"  class="nav-link">
                                        <i class="nav-icon fas fa-check-double"></i>
                                        <p>
                                        Valider heure
                                      <span class="badge badge-info right">new</span>
                                        </p>
                                    </a>
                                    </li>
                                    <li class="nav-item has-treeview menu-open">
                                        <a  href="{{route('Chartsrh')}}" href="#" class="nav-link">
                                            <i class="fas fa-chart-bar"></i>
                                            <p>
                                                Statistiques
                                            </p>
                                        </a>
                                    <li class="nav-item has-treeview menu-open">
                                    <a  href="{{route('Validation')}}" href="#" class="nav-link">
                                        <i class="nav-icon fas fa-eye"></i>
                                        <p>
                                        Consulter agent
                                        </p>
                                    </a>
                                    </li>
                    </ul>

                    @break
                    @case('dcm')
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">

                                    <div class="nav-link" style="color:white;">
                                        <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p > Navigateur</p>
                                    </div>
                                    </div>
                                      <li class="nav-item has-treeview menu-open">
                                                <a  href="{{route('Acceuil')}}" href="#" class="nav-link">
                                                    <i class="fas fa-home"></i>
                                                    <p>
                                                   Acceuil
                                                    </p>
                                                </a>
                                            </li>

                                    <li class="nav-item has-treeview menu-open">
                                    <a  href="{{route('Validation')}}"  class="nav-link">
                                        <i class="nav-icon fas fa-check-double"></i>
                                        <p>
                                        Valider heure
                                      <span class="badge badge-info right">new</span>
                                        </p>
                                    </a>
                                    </li>
                                    <li class="nav-item has-treeview menu-open">
                                        <a  href="{{route('Chartsrh')}}" href="#" class="nav-link">
                                            <i class="fas fa-chart-bar"></i>
                                            <p>
                                                Statistiques
                                            </p>
                                        </a>
                                    <li class="nav-item has-treeview menu-open">
                                    <a  href="{{route('Validation')}}" href="#" class="nav-link">
                                        <i class="nav-icon fas fa-eye"></i>
                                        <p>
                                        Consulter agent
                                        </p>
                                    </a>
                                    </li>
                    </ul>
                    @break


            @endswitch
                  @endif
    @endforeach
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
 @yield('content')

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/fullcalendar/main.min.js"></script>
<script src="../plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="../plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="../plugins/fullcalendar-interaction/main.min.js"></script>
<script src="../plugins/fullcalendar-bootstrap/main.min.js"></script>
<script src='../plugins/fullcalendar/locales/fr.js'></script>

<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendarInteraction.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        console.log(eventEl);
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
        plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
      locale: 'fr',
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
        'themeSystem': 'bootstrap',
        //Random default events
        events    : [
          {
            title          : 'All Day Event',
            start          : new Date(y, m, 1),
            backgroundColor: '#f56954', //red
            borderColor    : '#f56954', //red
            allDay         : true
          },
          {
            title          : 'Long Event',
            start          : new Date(y, m, d - 5),
            end            : new Date(y, m, d - 2),
            backgroundColor: '#f39c12', //yellow
            borderColor    : '#f39c12' //yellow
          },
          {
            title          : 'Meeting',
            start          : new Date(y, m, d, 10, 30),
            allDay         : false,
            backgroundColor: '#0073b7', //Blue
            borderColor    : '#0073b7' //Blue
          },
          {
            title          : 'Lunch',
            start          : new Date(y, m, d, 12, 0),
            end            : new Date(y, m, d, 14, 0),
            allDay         : false,
            backgroundColor: '#00c0ef', //Info (aqua)
            borderColor    : '#00c0ef' //Info (aqua)
          },
          {
            title          : 'Birthday Party',
            start          : new Date(y, m, d + 1, 19, 0),
            end            : new Date(y, m, d + 1, 22, 30),
            allDay         : false,
            backgroundColor: '#00a65a', //Success (green)
            borderColor    : '#00a65a' //Success (green)
          },
          {
            title          : 'Click for Google',
            start          : new Date(y, m, 28),
            end            : new Date(y, m, 29),
            url            : 'http://google.com/',
            backgroundColor: '#3c8dbc', //Primary (light-blue)
            borderColor    : '#3c8dbc' //Primary (light-blue)
          }
        ],

        editable  : true,
        droppable : true, // this allows things to be dropped onto the calendar !!!
        drop      : function(info) {
          // is the "remove after drop" checkbox checked?
          if (checkbox.checked) {
            // if so, remove the element from the "Draggable Events" list
            info.draggedEl.parentNode.removeChild(info.draggedEl);
          }
        }
      });

      calendar.render();
      // $('#calendar').fullCalendar()

      /* ADDING EVENTS */
      var currColor = '#3c8dbc' //Red by default
      //Color chooser button
      var colorChooser = $('#color-chooser-btn')
      $('#color-chooser > li > a').click(function (e) {
        e.preventDefault()
        //Save color
        currColor = $(this).css('color')
        //Add color effect to button
        $('#add-new-event').css({
          'background-color': currColor,
          'border-color'    : currColor
        })
      })
      $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      ini_events(event)

      //Remove event from text input
      $('#new-event').val('')


      calendar.setOption('locale', 'fr');

      })
    })
  </script>
  </body>
  </html>

