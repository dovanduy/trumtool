@extends('layouts.dashboard')
@section('content_dashboard')
<section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>403</h1>
                <h3 class="text-uppercase">Forbiddon Error!</h3>
                <p class="text-muted m-t-30 m-b-30">YOU DON'T HAVE PERMISSION TO ACCESS .</p>
                <a href="{{route('dashboard.index')}}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>
          
        </div>
    </section>
@endsection