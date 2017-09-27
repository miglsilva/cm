@extends('layouts.master')

@section('title')
    Shopping Checkout Cart
@endsection

@section('content')
<div class="row">
	<div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
		<h1>Checkout<h1>
		<h4>Total : $ {{ $total }} </h4>
		<div id="charge-error" class="alert alert-danger {{ !Session::has('error') ? 'hidden' : '' }}">
			{{ Session::get('error') }}			
		</div>
		<form action="{{ route('checkout') }}" method="post" id="checkout-form">
			<div class="row">
				<div class="col-xs-12">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="name" class="form-control" required>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" name="address" class="form-control" required>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<label for="credit-name">Card Holder Name</label>
						<input type="text" name="card-name" class="form-control" required>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<label for="credit-number">Credit Card Number</label>
						<input type="text" name="card-number" class="form-control" required>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-6">
							<div class="form-group">
								<label for="card-expiry-month">Expiry Month</label>
								<input type="text" name="card-expiry-month" class="form-control" required>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="form-group">
								<label for="card-expiry-year">Expiry Year</label>
								<input type="text" name="card-expiry-year" class="form-control" required>
							</div>	
						</div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="form-group">
						<label for="card-cvc">CVC</label>
						<input type="text" name="card-cvc" class="form-control" required>
					</div>
				</div>
			</div>
			{{ csrf_field() }}
			<button type="submit" class="btn btn-sucess">Buy Now</button>	
		</form>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript" src="{{url('js/checkout.js')}}"></script>
@endsection