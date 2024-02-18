<!doctype html>
<html lang="en">
    @php
        use App\Models\User;
        use App\Models\Department;
        use App\Models\Status;
    @endphp
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <style>
            hr{
                background:black !important;
            }
            
            strong{
                min-width: 150px !important;
            }
        </style>
    </head>

    <body>
        <div class="container my-5 p-5" style=" border:1px solid black; border-radius:10px;">
            <div class="row">
                {{-- <div class="col-md-3 d-flex justify-content-end">
                    <div>
                        <img src="/images/logo.png" alt="" style="width:50px;height:50px;">
                    </div>
                </div> --}}
                <div class="col-md-8">
                    <div class="row">
                        <h5 class="text-center">iDesk - Helpdesk Ticketing System</h5>
                    </div>
                    <div class="row">
                        <p class="text-center">Seamless Support, Swift Resolutions.</p>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <strong>Subject - <i>{{ strtoupper($ticket['subject']) }}</i></strong>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <strong>Description - <i>{{ $ticket['description'] }}</i> </strong>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <strong>Ticket Created By - <i>{{ $ticketUser['name'] }}</i> </strong>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <strong>Ticket Created On - <i>{{ $ticket['created_at']->format('F j, Y h:i A') }}</i></strong>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <strong>Department -  <i>{{ Department::find($ticket['department_id'])['department'] }}</i></strong>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <strong>Assigned To - <i>{{ User::find($ticket['agent_id'])['name'] }}</i></strong>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <strong>Status - <i>{{ Status::find($ticket['status_id'])['status_name'] }}</i></strong>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <strong>Download Date - <i>{{ now()->format('F j, Y h:i A') }}</i> </strong>
                </div>
            </div>
            <hr>
        </div>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
