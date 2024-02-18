@extends('adminPages.adminPageMasterLayout')
@section('title')
    Ticket Report
@endsection
@php
    use App\Models\Department;
@endphp
@push('customstyle')
    <style>
        .ticketreport {
            background: red;
        }

        label {
            color: white;
        }

        hr {
            background: white;
        }

        .table {
            color: white;
        }

        .agentForm,
        .listagents {
            background: rgba(0, 0, 0, 0.5);
            padding: 50px;
        }
    </style>
@endpush
@section('content')
<div class="container my-5 p-5" style="border:1px solid black; border-radius:10px;  background: rgba(0,0,0,0.5); color:white;">
    <h5 class="text-white">Create Ticket Status</h5>
    <hr class="mb-5">
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
@endsection