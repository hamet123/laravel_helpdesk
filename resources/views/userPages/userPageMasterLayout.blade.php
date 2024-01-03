<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/33b31a14a3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/styles.css">
    <title>iDesk - @yield('title')</title>
    @stack('customstyle')
   
</head>

<body>
    @include('layouts.navbar')
    
   @include('layouts.errorBoxes')
   
    <div class="container mt-5">
        <div class="row">

        
            <div class="col-md-2">
                <div class="navdiv navdiv-active-all-tickets">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-2">
                            <i class="fa-solid fa-ticket" style="font-size: 1.73em;"></i>
                        </div>
                        <div class="col-xl-10">
                            <a href="/user-dashboard" class="text-light"><span>All Tickets<span></a>
                        </div>
                    </div>
                </div>
            </div>
        


            <div class="col-md-2">
                <div class="navdiv navdiv-active-create-ticket">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-2">
                            <i class="fa-solid fa-plus" style="font-size: 1.73em;"></i>
                        </div>
                        <div class="col-xl-9">
                            <a href="{{ route('getCreateTicket') }}" class="text-light"><span>Create Ticket<span></a>
                        </div>
                    </div>
                </div>
            </div>


        
            <div class="col-md-2">
                <div class="navdiv navdiv-active-pending-tickets">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-2">
                            <i class="fa-solid fa-ticket-simple" style="font-size: 1.73em;"></i>
                        </div>
                        <div class="col-xl-10">
                            <a href="/pending-tickets" class="text-light"><span>Pending Tickets<span></a>
                        </div>
                    </div>
                </div>
            </div>
        



        
            <div class="col-md-2">
                <div class="navdiv navdiv-active-closed-tickets">
                    <div class="row d-flex align-items-center">
                        <div class="col-xl-2">
                            <i class="fa-solid fa-clipboard-check" style="font-size: 1.73em;"></i>
                        </div>
                        <div class="col-xl-9">
                            <a href="/closed-tickets" class="text-light"><span>Closed Tickets<span> </a>
                        </div>
                    </div>
                </div>   
            </div>
       



        
            <div class="col-md-2">
                <div class="navdiv navdiv-active-my-profile">
                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-xl-2">
                            <i class="fa-solid fa-user" style="font-size: 1.73em;"></i>
                        </div>
                        <div class="col-xl-9">
                            <a href="/my-profile" class="text-light"><span>My Profile<span> </a>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-2">
                <div class="navdiv navdiv-active-home">
                    <div class="row d-flex align-items-center justify-content-center">
                        <div class="col-xl-2">
                            <i class="fa-solid fa-home" style="font-size: 1.73em;"></i>
                        </div>
                        <div class="col-xl-9">
                            <a href="/" class="text-light"><span>Home<span> </a>
                        </div>
                    </div>
                </div>
            </div>
       

        </div>
    </div>


<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12" style="height:auto; padding-bottom:100px;">
            @yield('usercontent')
        </div>
   </div>
</div>

   


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    @include('Layouts.footer')
</body>

</html>