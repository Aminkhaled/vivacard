@extends('general::layouts.master')

@section('main')
  <main class="main">

	<div class="container-fluid">
		<div class="animated fadeIn">

			<div class="row align-items-center mt-5">
				<div class="col-12">
					<div class="card mt-5 bg-transparent border-0">
						<div class="card-body text-center">
							<img src="{{ asset($locale == 'ar' ? 'assets/adminPanel/img/logo-ar.png' : 'assets/adminPanel/img/logo-en.png') }}" class="img-fluid ">
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

  </main>
@endsection


