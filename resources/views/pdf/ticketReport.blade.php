<!doctype html>
<html lang="en">
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
        <link rel="stylesheet" href="css/styles.css">
        <style>
            th,td {
                border:1px solid black;
                padding:10px;
            }
        </style>
    </head>

    <body>
       <div class="container my-5">
        <div class="row">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th colspan="6"><h5 class="text-center">Tickets Report</h5></th>
                        </tr>
                        <tr>
                            <th scope="col">Sr. No.</th>
                            <th scope="col">Created By</th>
                            <th scope="col">Created On</th>
                            <th scope="col">Department</th>
                            <th scope="col">Assigned To</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $serialNumber = 0;
                        @endphp
                        @forelse ($tickets as $ticket)
                        @php
                            $serialNumber++;
                        @endphp
                        <tr>
                            <th>{{ $serialNumber }}</th>
                            <th>{{ App\Models\User::find($ticket['user_id'])['name'] }}</th>
                            <th>{{ $ticket['created_at']->format('F j, Y h:i A') }}</th>
                            <th>{{ App\Models\Department::find($ticket['department_id'])['department'] }}</th>
                            <th>{{ App\Models\User::find($ticket['agent_id'])['name'] }}</th>
                            <th>{{ App\Models\Status::find($ticket['status_id'])['status_name'] }}</th>
                        </tr>
                        @empty
                            <tr>
                            <th colspan="6">No Record Found</th>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
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
