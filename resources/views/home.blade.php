@extends('layouts.app')

@section('content')
<!-- Halaman Setelah Login -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Message Info -->
                    @if (Session::has('message'))
                    <?php  $message = Session::get('message'); ?> @if( $message["action"] == "success" )
                    <div class="alert alert-success" align="center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <i class="fa fa-check-circle-o fw"></i> &nbsp; {!! $message["message"] !!}
                    </div>
                    @elseif ( $message["action"] == "error" )
                    <div class="alert alert-danger" align="center">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <i class="fa fa-times-circle-o fw"></i> &nbsp; {!! $message["message"] !!}
                    </div>
                    @endif
                    <?php Session::forget('message'); ?>
                    @endif
                    <!-- End: Message Info -->

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
