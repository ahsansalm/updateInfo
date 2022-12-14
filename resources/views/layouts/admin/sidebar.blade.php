
<aside class="left-sidebar bg-sidebar" style="background: #0C1741!important">
          <div id="sidebar" class="sidebar sidebar-with-footer">
            <!-- Aplication Brand -->
            <div class="app-brand" style="background: white !important;">
              <a href="{{url('/home')}}">
                <span class="brand-name">
                  <img src="{{asset('img/logo/logo.png')}}" style="max-width:160px !important;"alt="">
                </span>
                
              </a>
            </div>
            <!-- begin sidebar scrollbar -->
            <div class="sidebar-scrollbar">

              <!-- sidebar menu -->
              <ul class="nav sidebar-inner" id="sidebar-menu" style="margin-top: 0px !important;">
                

                
                  <!-- problems of users -->
                  <?php $role = Auth::user()->role_as; ?>
                  @if($role == 1)
                  

                   
                  <li  class="has-sub {{ Request::is('home') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/home')}}" >
                    <i class="fa fa-user" style="font-size:24px"></i>
                      <span class="nav-text">Rapports</span> 
                    </a>
                  </li>




                  
                  <li  class="has-sub {{ Request::is('adminUser') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/adminUser')}}" >
                    <i class="fa fa-user" style="font-size:24px"></i>
                      <span class="nav-text">Utilisateurs</span> 
                    </a>
                  </li>



                  <!-- <li  class="has-sub active colorBack" >
                    <a class="sidenav-item-link" aria-controls="dashboard">
                      <span class="nav-text">Problèmes utilisateur</span> 
                    </a>
                  </li>  -->
                  <li  class="has-sub {{ Request::is('problem') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/problem')}}" >
                    <i class="fa fa-question-circle" style="font-size:24px"></i>
                      <span class="nav-text">Problèmes</span> 
                      @if(isset($Parcel))
                        @if($Parcel->admin_noti == "Nouveau")
                          <span class="badge bg-danger ml-3">{{$Parcel->admin_noti}}</span> 
                        @endif
                       @endif
                      </span> 
                    </a>
                  </li>





                  
                  <li  class="has-sub {{ Request::is('inventory') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/inventory')}}" >
                    <i class="fa fa-user" style="font-size:24px"></i>
                      <span class="nav-text">Inventaire</span> 
                    </a>
                  </li>




                  <li  class="has-sub active colorBack" >
                    <a class="sidenav-item-link" aria-controls="dashboard">
                      <span class="nav-text">Ordres</span> 
                    </a>
                  </li> 
                  <li  class="has-sub {{ Request::is('userOrder') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/userOrder')}}" >
                    <i class="fa fa-suitcase" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Ordres
                      @if(isset($Parcel))
                        @if($Parcel->order_noti == "Nouveau")
                          <span class="badge bg-danger ml-3">Neuf</span> 
                        @endif
                       @endif
                      </span> 
                    </a>
                  </li>
                  <li  class="has-sub {{ Request::is('userQuotes') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/userQuotes')}}" >
                    <i class="fa fa-book" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Devis
                      @if(isset($Invoice))
                        @if($Invoice->quote_noti == "neuf")
                          <span class="badge bg-danger ml-3">Neuf</span> 
                        @endif
                       @endif
                      </span> 
                    </a>
                  </li>

              
                  <li  class="has-sub active colorBack " >
                    <a class="sidenav-item-link" aria-controls="dashboard">
                      <span class="nav-text">Liste de choses à faire</span> 
                    </a>
                  </li> 
                  <li  class="has-sub {{ Request::is('todolist') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/todolist')}}" >
                    <i class="fa fa-book" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Liste de tâches</span> 
                    </a>
                  </li>

                  <li  class="has-sub {{ Request::is('favlist') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/favlist')}}" >
                    <i class="fa fa-book" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Liste des favoris</span> 
                    </a>
                  </li>

                  <li  class="has-sub {{ Request::is('comlist') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/comlist')}}" >
                    <i class="fa fa-book" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Tâche terminée</span> 
                    </a>
                  </li>

                  <li  class="has-sub {{ Request::is('vendorlist') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/vendorlist')}}" >
                    <i class="fa fa-book" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Liste de fournisseurs</span> 
                    </a>
                  </li>


                  <li  class="has-sub {{ Request::is('vendorfavlist') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/vendorfavlist')}}" >
                    <i class="fa fa-book" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Favori du vendeur</span> 
                    </a>
                  </li>

                  

                  <li  class="has-sub active colorBack " >
                    <a class="sidenav-item-link" aria-controls="dashboard">
                      <span class="nav-text">Config</span> 
                    </a>
                  </li> 
                  <li  class="has-sub {{ Request::is('configuration') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/configuration')}}" >
                    <i class="fa fa-book" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Configuration</span> 
                    </a>
                  </li>

                  @else
                  <!-- dashboard -->
                  <li  class="has-sub {{ Request::is('home') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/home')}}" >
                      <i class="mdi mdi-view-dashboard-outline"></i>
                      <span class="nav-text">Tableau de bord</span> 
                    </a>
                  </li>
                <!-- my account -->
                <li  class="has-sub active colorBack" >
                    <a class="sidenav-item-link" aria-controls="dashboard">
                      <span class="nav-text">Mon compte</span> 
                    </a>
                  </li>
                <!-- my device -->
                <li  class="has-sub {{ Request::is('MyProfile') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/MyProfile')}}" aria-controls="dashboard">
                      <i class="mdi mdi-image-filter-none"></i>
                        <span class="nav-text">Mon information</span> 
                    </a>
                  </li>
                <!-- my devices -->
                <li  class="has-sub {{ Request::is('MyDevices') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/MyDevices')}}">
                    <i class="fa fa-desktop" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Mes appareils
                      @if(isset($Parcel))
                        @if($Parcel->device_noti == "Nouveau")
                          <span class="badge bg-danger ml-1 px-1">Neuf</span> 
                        @endif
                       @endif
                      </span> 
                    </a>
                  </li>
                <!-- send parcel -->
                <li  class="has-sub {{ Request::is('SendParcel') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/SendParcel')}}">
                    <i class="fa fa-envelope" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Envoyer un colis</span> 
                    </a>
                  </li>
                <!-- my document -->
                <li  class="has-sub active colorBack " >
                    <a class="sidenav-item-link" aria-controls="dashboard">
                      <span class="nav-text">Mon document</span> 
                    </a>
                  </li>
                <!-- my support -->
                <li  class="has-sub {{ Request::is('MySupport') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/MySupport')}}">
                    <i class="fa fa-paper-plane-o" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Mon support 
                        @if(isset($Parcel))
                          @if($Parcel->noti == "Nouveau")
                          <span class="badge bg-danger ml-3">Nuef</span>
                          @endif
                        @endif
                      </span> 
                    </a>
                  </li>
                   <!-- my notification -->
                <!-- <li  class="has-sub {{ Request::is('notification') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/notification')}}">
                    <i class="fa fa-bell-o" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Notification</span> 
                    </a>
                  </li> -->
                <!-- my quotes -->
                <li  class="has-sub {{ Request::is('MyQuotes') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/MyQuotes')}}">
                    <i class="fa fa-book" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Mes citations
                      @if(isset($Invoice))
                          @if($Invoice->user_quote_noti == "Neuf")
                          <span class="badge bg-danger ml-3">Nuef</span>
                          @endif
                        @endif
                      </span> 
                    </a>
                  </li>
                <!-- my bill  -->
                <li  class="has-sub {{ Request::is('MyBill') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/MyBill')}}">
                    <i class="fa fa-sticky-note" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Mes factures</span> 
                    </a>
                  </li>
                <!-- my order -->
                
                <li  class="has-sub {{ Request::is('MyOrder') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/MyOrder')}}">
                    <i class="fa fa-suitcase" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Ou. Non Approuver</span> 
                      @if(isset($Parcel))
                        @if($Parcel->order_approved_noti == "Refus")
                          <span class="badge bg-danger ml-1 px-1">Neuf</span> 
                        @endif
                       @endif
                    </a>
                  </li>
                   <!-- my order approved -->
                
                <li  class="has-sub {{ Request::is('ApprovedOrder') ? 'active':''; }}" >
                    <a class="sidenav-item-link" href="{{url('/ApprovedOrder')}}">
                    <i class="fa fa-check-square" style="font-size:24px;color:white"></i>
                      <span class="nav-text">Ou. Approuver
                      @if(isset($Parcel))
                        @if($Parcel->order_approved_noti == "Nouveau")
                          <span class="badge bg-danger ml-1 px-1">Neuf</span> 
                        @endif
                       @endif
                      </span> 
                    </a>
                  </li>
                <!-- remote support -->
                <li  class="has-sub active colorBack " >
                    <a class="sidenav-item-link" aria-controls="dashboard">
                      <span class="nav-text">Assistance à distance</span> 
                    </a>
                  </li>
                <!-- support portfolio -->
                <li  class="has-sub {{ Request::is('SupportWallet') ? 'active':''; }}" >
                    <a class="sidenav-item-link"  href="{{url('/SupportWallet')}}" aria-controls="dashboard">
                      <i class="mdi mdi-view-dashboard-outline"></i>
                      <span class="nav-text">Portefeuille de soutien</span> 
                    </a>
                </li>
                @endif 


 
                  <hr class="separator" />

            
          </div>
        </aside>