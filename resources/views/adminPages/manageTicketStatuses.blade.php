@extends('adminPages.adminPageMasterLayout')
@section('title') Manage Statuses @endsection
@push('customstyle')
   <style>
     .manageTicketStatuses {
        background: red;
    }
   </style>
@endpush
@section('content')
   <h1>MANAGE Ticket Statuses Here</h1>
@endsection