<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
                    @if(Storage::disk('public')->has($user->name . '-' . $user->id . '-' . '.jpg'))
		            <img src="{{ url('account-image',['filename' => $user->name . '-' . $user->id . '-' . '.jpg'])}}" alt="" class="img-responsive">
		            <div class="remove">
		                <a href="{{ url('/account/delete-image', ['filename' => $user->name . '-' . $user->id . '-' . '.jpg' ]) }}"><i class="fa fa-times" aria-hidden="true"></i></a>
		            </div>    
		            @else
		                <div class="">
		                    <img src="{{ url('account-image', ['filename' => $user->avatar])}}" alt="" class="img-responsive">
		                </div>
		            @endif  
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{ $user->name }}
					</div>
					<div class="profile-usertitle-job">
						@if($user->role == 0)
							User
						@else
							Admin
						@endif
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					<button type="button" class="btn btn-success btn-sm">Follow</button>
					<button type="button" class="btn btn-danger btn-sm">Message</button>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav" id="account_menu">
						<li class="{{ Route::currentRouteName() == 'account' ? 'active' : '' }}">
							<a href="{{ url('/account') }}">
							<i class="glyphicon glyphicon-home"></i>
							Overview </a>
						</li>
						<li class="{{ Route::currentRouteName() == 'account-settings' ? 'active' : '' }}">
							<a href="{{ url('/account-settings') }}">
							<i class="glyphicon glyphicon-user"></i>
							Account Settings </a>
						</li>
						@if($user->role == 1)
						<li class="{{ Route::currentRouteName() == 'agents' ? 'active' : '' }}">
							<a href="{{ url('/agents') }}">
							<i class="glyphicon glyphicon-th-list"></i>
							Agents </a>
						</li>
						<li class="{{ Route::currentRouteName() == 'users' ? 'active' : '' }}">
							<a href="{{ url('/users') }}">
							<i class="glyphicon glyphicon-list"></i>
							Users </a>
						</li>
						@endif
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>