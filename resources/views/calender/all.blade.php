
@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
  @endsection
@section('content')
<div class="container">
    @can('create', App\Models\Event::class) 
    <div class="row" id="addCalender">
          <button type="button" onclick="addCalenderModal()" type="button" class="btn btn-primary btn-sm">
            Add an Event
          </button>
    </div>
    @endcan
    <div class="row full-calendar">

        <div class="col-sm-12">
            <div id="calendar"></div>
        </div>
    </div>
</div>  
<script src="{{ asset('js/calender.js') }}" defer></script>


<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="wholeDay" id="wholeDay">
            <label class="form-check-label" for="wholeDay">
                All Day Event
            </label>
        </div> 

        <div class="form-group">
            <label for="start">Start</label>
            <input type="date" class="form-control" id="start" name="start"  value="<?php echo date('Y-m-d'); ?>" placeholder="Enter start date">
            <input type="time" class="form-control" id="start_time" name="start_time" />

          </div>
        <div class="form-group">
            <label for="end">End</label>
            <input type="date" class="form-control" id="end" name="end" value="<?php echo date('Y-m-d'); ?>" placeholder="Enter end date">
            <input type="time" class="form-control" id="end_time" name="end_time" />
          </div>
        <input type="hidden" name="type" value="add" id="type" /> 
        <input type="hidden" name="id" id="id" /> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
        <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection