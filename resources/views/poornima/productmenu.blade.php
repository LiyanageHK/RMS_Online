@extends('layouts.appclient')

@section('content')

<br><br><br><br><br><br><br>

<form method="GET" action="{{ route('productdetails.view') }}" enctype="multipart/form-data">
    @csrf
  <div class="modal-body">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" class="form-control" id="pid" name="pid">
    </div>
   
    
     

  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Save changes</button>
  </div>
  </form>




  @endsection