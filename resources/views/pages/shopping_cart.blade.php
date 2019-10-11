@extends('master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Shopping Cart</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Home</a> / <span>Shopping Cart</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
		<div id="content">
			
			<div class="table-responsive">
				<!-- Shop Products Table -->
				<table class="shop_table beta-shopping-cart-table" cellspacing="0">
					<thead>
						<tr>
							<th class="product-name">Product</th>
							<th class="product-price">Price</th>
							<th class="product-status">Status</th>
							<th class="product-quantity">Quantity</th>
							<th class="product-subtotal">Total</th>
							<th class="product-remove">Remove</th>
						</tr>
					</thead>
					<tbody>
						<?php $total = 0; ?>
						@foreach( $cartProducts as $cartProduct )
						<tr class="cart_item">
							<td class="product-name">
								<div class="media">
									<img class="pull-left" src="frontEnd/assets/dest/images/shoping1.jpg" alt="">
									<div class="media-body">
										<p class="font-large table-title">{{ $cartProduct->name }}</p>

										@foreach($categories as $item)
                                        @if( $cartProduct->options->cateId == $item->id )			
										<p class="table-option">Thể loại:{{ $item->name }} </p>
										@endif
										@endforeach
										
										<p class="table-option">Hãng: Điện thoại </p>
									</div>
								</div>
							</td>

							<td class="product-price">
								<span class="amount">{{ $cartProduct->price }}</span>
							</td>

							<td class="product-status">
								In Stock
							</td>

							<td class="product-quantity">

							{!! Form::open(['url'=>'home/updateCart','method'=>'POST']) !!}

								<input type="number" name="qty" id="product-qty" min="1" value="{{ $cartProduct->qty }}"></input>
								<input type="hidden" value="{{ $cartProduct->rowId }}" name="rowId">
								<input type="submit" class="update-qty" value="Update"></input> 

							{!! Form::close() !!}
							
							</td>
							
							<?php $subTotal = ($cartProduct->qty)*($cartProduct->price); ?>

							<td class="product-subtotal">
								<span class="amount">{{ $subTotal }}</span>
							</td>

							<td class="product-remove">
								<a href="{{ Route('home.removeCart', $cartProduct->rowId) }}" class="remove" title="Remove this item"><i class="fa fa-trash-o"></i></a>
							</td>
						</tr>

						<?php  $total = $total+$subTotal; ?>

						@endforeach
					</tbody>

					<tfoot>
						<tr>
							<td colspan="6" class="actions">

								<div class="cart-totals pull-right">
									<div class="cart-totals-row"><span>Cart Total:</span> 
										<span><?php echo number_format($total) ?> </span>
									</div>
								</div>	
								
								<button type="submit" class="beta-btn primary" id="btnCheckout" name="proceed"><a id="linkCheckout" href="{{Route('home.checkout')}}">Proceed to Checkout </a></button>
								<div class="clearfix"></div>
							</td>
						</tr>
					</tfoot>
				</table>
				<!-- End of Shop Table Products -->
			</div>
			<!-- End of Cart Collaterals -->
			<div class="clearfix"></div>

		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection