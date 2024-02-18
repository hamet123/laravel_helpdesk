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
    </head>

    <body>
        <div class="container my-5 p-5" style="border:1px solid black; border-radius:10px; width:50%; background: rgba(0,0,0,0.7); color:white;">
            <div class="row">
                <form action="/ticket-report" method="POST">
                    @csrf
                    <label for="department" class="form-label">Select Department</label>
                    <select class="form-control" name="department" id="department">
                        <option value="" selected>Select Department</option>
                        @forelse ($departments as $department)
                            <option value="{{ $department['id'] }}">{{ $department['department'] }}</option>
                        @empty
                            <option value="">No Departments Found</option>
                        @endforelse
                    </select>
                    <hr>
                    <h5 class="text-center mt-5">--OR--</h5>
                    <label for="agent" class="form-label">Select Agent</label>
                    <select class="form-control" name="agent" id="agent">
                        <option value="" selected>Select Agent</option>
                        @forelse ($agents as $agent)
                            <option value="{{ $agent['id'] }}">{{ $agent['name'] }}</option>
                        @empty
                            <option value="">No Agents Found</option>
                        @endforelse
                    </select>
                    <hr>
                    <h5 class="text-center mt-5">--OR--</h5>
                    <label for="status" class="form-label">Select Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="" selected>Select Status</option>
                        @forelse ($statuses as $status)
                            <option value="{{ $status['id'] }}">{{ $status['status_name'] }}</option>
                        @empty
                            <option value="">No Status Found</option>
                        @endforelse
                    </select>
                    <button class="btn my-4 btn-danger">Download Report</button>
                </form>
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
