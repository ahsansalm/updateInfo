<style>
    .navbar .navbar-right .navbar-nav .notifications-menu .dropdown-toggle:after {
    display:none;
}
.ff{
    font-size: 10px !important;
    position: absolute;
    top: 13px;
    left: 44px;
}
.nn{
    
    overflow-y: scroll;
}
.navbar .navbar-right .navbar-nav .notifications-menu > .dropdown-menu {
    height: 300px;
    width: 350px;
}
</style>
<h1 class="topicon">I</h1>
<header class="main-header " id="header">

    <nav class="navbar navbar-static-top navbar-expand-lg">
    
        <!-- Sidebar toggle button -->
        <button id="sidebar-toggler" class="sidebar-toggle">
        <i class="fa fa-align-justify"></i>
        <span class="sr-only">Toggle navigation</span>
        </button>
        <!-- search form -->
        <div class="search-form d-none d-lg-inline-block">
        <div class="input-group">
            <button type="button" name="search" id="search-btn" class="btn btn-flat">
            </button>
        </div>
        <div id="search-results-container">
            <ul id="search-results">
         
            </ul>
        </div>
        </div>

        <div class="navbar-right  text-dark">
                <ul class="nav navbar-nav">
                    <!-- User Account -->



                    <!-- payment -->

                    <li class="dropdown notifications-menu">
                                    <?php $role = Auth::user()->role_as; ?>
                        @if($role == '1')
                                <button class="dropdown-toggle payU" data-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-credit-card"></i>
                                    @if($payU->status == "Neuf")
                                        <span class="badge ff bg-primary badge-sm">N</span>
                                    @endif
                                @else

                                 <button class="dropdown-toggle payU2" data-toggle="dropdown" aria-expanded="false">
                              <i class="fa fa-credit-card"></i>
                                    @if($payU2->status == "Neuf")
                                        <span class="badge ff bg-primary badge-sm">N</span>
                                    @endif
                        @endif
                    
                             
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right nn">
                                <li class="dropdown-header">Crédits payés</li>
                                
                                    @if($role == 1)
                                    @foreach($paymentU as $payu)
                                        <li>
                                        <a href="{{url('/User/detail/'.$payu->userId)}}">
                                            <img src="{{$payu->data->photo}}"  style="height: 30px; width: 30px;   border-radius: 50%;" alt="">

                                            <b class="ml-1">{{$payu->data->firstname}} {{$payu->description}} Pour {{$payu->productId}}</b>
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> {{$payu->created_at}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                    @else
                                    @foreach($paymentU2 as $payu2)
                                        <li>
                                            <a href="{{url('/MyBill')}}">

                                            <b class="ml-1">{{$payu2->description}}</b>
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> {{$payu2->created_at}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                    @endif
                            </ul>
                    </li>

                    
                    <li class="dropdown notifications-menu">
                                    <?php $role = Auth::user()->role_as; ?>
                        @if($role == '1')
                                <button class="dropdown-toggle msg" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                    @if($msg->userStatus == "Neuf")
                                        <span class="badge ff bg-primary badge-sm">N</span>
                                    @endif
                                @else
                        <button class="dropdown-toggle msg2" data-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                    @if($msg2->adminId == "Neuf")
                                        <span class="badge ff bg-primary badge-sm">N</span>
                                    @endif
                        @endif
                    
                             
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right nn">
                                <li class="dropdown-header">Messages</li>
                                
                                    @if($role == 1)
                                    @foreach($message as $msg)
                                        <li>
                                            <a href="{{url('/problem/Detail/'.$msg->productId)}}">
                                            <img src="{{$msg->data->photo}}"  style="height: 30px; width: 30px;   border-radius: 50%;" alt="">

                                            <b class="ml-1">{{$msg->data->firstname}}Vous envoyer un message</b>
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> {{$msg->created_at}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                    @else
                                    @foreach($message2 as $msg2)
                                        <li>
                                            <a href="{{url('/Support/Detail/'.$msg2->productId)}}">

                                            <b class="ml-1">   Administrateur  Vous envoyer un message</b>
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> {{$msg2->created_at}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                    @endif
                            </ul>
                    </li>



                    <li class="dropdown notifications-menu">
                        
                        <?php $role = Auth::user()->role_as; ?>
                        @if($role == '1')
                                <button class="dropdown-toggle noti" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-bell-outline"></i>
                                    @if(isset($notiF))
                                        @if($notiF->status == "Neuf")
                                        <span class="badge ff bg-primary badge-sm">N</span>
                                        @endif
                                    @endif
                        @else
                        <button class="dropdown-toggle noti2" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-bell-outline"></i>
                                
                                    @if(isset($notiF2))
                                        @if($notiF2->or_status == "Neuf")
                                        <span class="badge ff bg-primary badge-sm">N</span>
                                        @endif
                                    @endif

                        @endif

                            </button>
                            <ul class="dropdown-menu dropdown-menu-right nn">
                                <li class="dropdown-header">Nouvelles notifications</li>
                                
                                    @if($role == 1)
                                    @foreach($notification as $noti)
                                        <li>
                                            <a href="{{url('/Approved/order/detail/'.$noti->productId)}}">
                                            
                                        <img src="{{$noti->data->photo}}"  style="height: 30px; width: 30px;   border-radius: 50%;" alt="">
                                        <b class="ml-1">{{$noti->data->firstname}} {{$noti->description}}</b>
                                            <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> {{$noti->created_at}}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                    @else
                                        @foreach($notification2 as $noti2)
                                            <li>
                                                <a href="{{url('/MyBill')}}">
                                                <b>{{$noti2->description}}</b>
                                                <span class=" font-size-12 d-inline-block float-right"><i class="mdi mdi-clock-outline"></i> {{$noti2->created_at}}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                            </ul>
                    </li>




                    <li class="dropdown user-menu">
                        <button href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                            <span class="d-none d-lg-inline-block">{{auth()->user()->name}}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <!-- User image -->
                            <li class="dropdown-header">
                            <img src="{{auth()->user()->profile->photo}}"style="height:50px;" class="img-circle" >
                            <div class="d-inline-block">
                            {{auth()->user()->name}} <small class="pt-1">{{auth()->user()->email}}</small>
                            </div>
                            </li>

                            <li>
                            <a href="{{url('/MyProfile')}}">
                                <i class="mdi mdi-account"></i> Mon profil
                            </a>
                            </li>

                            <li class="dropdown-footer">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                                    <i class="mdi mdi-logout"></i>
                                    {{ __('Se déconnecter') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>

                </ul>
        </div>
    </nav>
</header>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
$(document).ready(function(){

 




    // data submit using ajax
    $(".noti").click(function () {
        $.ajax({
                    url: '{{ url('/Noti/ok') }}',
                    type:'get',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                        success:function(success){   
                            if(success){
                                
                            }              
                        }           
        }); 
    }); 




    $(".noti2").click(function () {
        $.ajax({
                    url: '{{ url('/Noti2/ok') }}',
                    type:'get',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                        success:function(success){   
                            if(success){
                                
                            }              
                        }           
        }); 
    }); 



        // data submit using ajax
        $(".msg").click(function () {
        $.ajax({
                    url: '{{ url('/msg/ok') }}',
                    type:'get',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                        success:function(success){   
                            if(success){
                                
                            }              
                        }           
        }); 
    }); 



          // data submit using ajax
          $(".msg2").click(function () {
        $.ajax({
                    url: '{{ url('/msg2/ok') }}',
                    type:'get',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                        success:function(success){   
                            if(success){
                                
                            }              
                        }           
        }); 
    }); 



           // data submit using ajax
           $(".payU").click(function () {
        $.ajax({
                    url: '{{ url('/payU/ok') }}',
                    type:'get',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                        success:function(success){   
                            if(success){
                                
                            }              
                        }           
        }); 
    }); 



               // data submit using ajax
               $(".payU2").click(function () {
        $.ajax({
                    url: '{{ url('/payU2/ok') }}',
                    type:'get',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                        success:function(success){   
                            if(success){
                                
                            }              
                        }           
        }); 
    }); 

});
</script>
