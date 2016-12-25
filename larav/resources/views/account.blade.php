@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row profile">
    <!-- ACCOUNT SIDEBAR -->
		@include('includes.account_sidebar')
		<!-- END ACCOUNT SIDEBAR -->
		<div class="col-md-9">
            <div class="profile-content">
			   What agents the user is following..., 
			   Feedback on agents the user is following
            </div>
		</div>
	</div>
</div>
@endsection
