	<!-- #header -->
	<div id="header">
		<div class="header-top">
			<div class="container">
				<div class="pull-left auto-width-left">
					<ul class="top-menu menu-beta l-inline">
						<li><a href=""><i class="fa fa-home"></i> Ngõ 197 Trần Phú, Văn Quán, Hà Đông, HN</a></li>
						<li><a href=""><i class="fa fa-phone"></i> 0964 648 152</a></li>
					</ul>
				</div>
				<div class="pull-right auto-width-right">
					<ul class="top-details menu-beta l-inline">
						<li><a href="#"><i class="fa fa-user"></i>Tài khoản</a></li>
						<li><a href="{{ Route('home.register') }}">Đăng kí</a></li>
						<li><a href="{{ Route('home.login') }}">Đăng nhập</a></li>
						<li><a href="{{ Route('home.index') }}">Logout</a></li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-top -->
		<div class="header-body">
			<div class="container beta-relative">
				<div class="pull-left">
					<a href="index.html" id="logo"><img src="frontEnd/assets/dest/images/logo-cake.png" width="200px" alt=""></a>
				</div>
				<div class="pull-right beta-components space-left ov">
					<div class="space10">&nbsp;</div>
					<div class="beta-comp">
						<form role="search" method="get" id="searchform" action="/">
							<input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." />
							<button class="fa fa-search" type="submit" id="searchsubmit"></button>
						</form>
					</div>
					
					<?php 
						$cartProducts = Cart::Content();
						$subtotal = Cart::subtotal();
						$countCart = Count($cartProducts);
					?> 

					<div class="beta-comp">
						<div class="cart">
							<div class="beta-select"><i class="fa fa-shopping-cart"></i>

								Giỏ hàng ( @if($countCart!=0) {{ $countCart }} @else Trống @endif ) 

								<i class="fa fa-chevron-down"></i></div>
							<div class="beta-dropdown cart-body">
							
								@foreach($cartProducts as $cartProduct  )
								<div class="cart-item">
									<div class="media">
										<a class="pull-left" href="#"><img src="frontEnd/assets/dest/images/products/cart/1.png" alt=""></a>
										<div class="media-body">
											<span class="cart-item-title">{{ $cartProduct->name }}</span>

											@foreach($categories as $item)
											@if( $cartProduct->options->cateId == $item->id )
											<span class="cart-item-options">Thể loại:{{ $item->name }} </span>
											@endif
											@endforeach

											<span class="cart-item-amount">{{ $cartProduct->qty }}*<span>{{ $cartProduct->price }}</span></span>
										</div>
										<div class="pro-del"><a href="{{ Route('home.removeCart', $cartProduct->rowId) }}"><i class="fa fa-times-circle"></i></a></div>
									</div>
								</div>
								@endforeach


								<div class="cart-caption">
									<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value"> {{ $subtotal }} VNĐ</span></div>
									<div class="clearfix"></div>

									<div class="center">
										<div class="space10">&nbsp;</div>
										<a href="{{ Route('home.checkout') }}" class="beta-btn primary text-center">Check Out <i class="fa fa-chevron-right"></i></a>
									</div>
								</div>

							</div>
						</div> <!-- .cart -->
					</div>
				</div>
				<div class="clearfix"></div>
			</div> <!-- .container -->
		</div> <!-- .header-body -->
		<div class="header-bottom" style="background-color: #0277b8; height: 60px;">
			<div class="container">
				<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
				<div class="visible-xs clearfix"></div>
				<nav class="main-menu">
					<ul class="l-inline ov">
						<li><a href="{{ Route('home.index') }}">Trang chủ</a></li>
						<li><a href="{{ Route('home.productType') }}">Sản phẩm</a>
							<ul class="sub-menu">
								<li><a href="{{ Route('home.productType') }}">Sản phẩm 1</a></li>
								<li><a href="{{ Route('home.productType') }}">Sản phẩm 2</a></li>
								<li><a href="{{ Route('home.productType') }}">Sản phẩm 4</a></li>
							</ul>
						</li>
						<li><a href="{{ Route('home.about') }}">Giới thiệu</a></li>
						<li><a href="{{ Route('home.contact') }}">Liên hệ</a></li>
						<li><a href="{{ Route('home.showShoppingCart') }}">Giỏ hàng</a></li>
					</ul>
					<div class="clearfix"></div>
				</nav>
			</div> <!-- .container -->
		</div> <!-- .header-bottom -->
	</div> 