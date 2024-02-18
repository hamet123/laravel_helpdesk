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
   <style>
   
   div.sidemenu {
  
}
    .sidemenu ul{
        list-style:none;
        background:rgba(0,0,0,0.7);  
        padding: 0px;
        margin:0px; 
    }
    .sidemenu ul li {
        color:white;
        font-weight: 600;
        
        border:1px solid grey;
        padding:20px;
    }

    .sidemenu ul a{
        text-decoration:none;
    }

    .sidemenu ul li:hover{
        background:rgb(226, 50, 50);
    }
   </style>
</head>

<body>
    @include('layouts.navbar')
    
   @include('layouts.errorBoxes')
   
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 mt-5">
            <div class="sidemenu">
                <ul class="">
                    <a href="/manage-departments"><li class="manageDepartments">Create and Manage Departments</li></a>
                    <a href="/manage-agents"><li class="manageAgents">Create and Manage Agents</li></a>
                    <a href="/manage-ticket-statuses"><li class="manageTicketStatuses">Create and Manage Ticket Statuses</li></a>
                    <a href="/admin-profile"><li class="adminProfile">Manage Your Profile</li></a>
                    <a href="/search-ticket"><li class="searchTicket">Search a Ticket</li></a>
                    <a href="/search-agents-and-users"><li class="searchAgentsAndUsers">Search Agents/Users</li></a>
                    <a href="/ticket-report"><li class="ticketreport">Reports</li></a>
                </ul>
            </div>
        </div>
        <div class="col-md-9 my-5">
            <div style="background:rgba(0,0,0,0.7); min-height:70vh; padding:30px; margin-bottom:50px;">
                @yield('content')
            </div>
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