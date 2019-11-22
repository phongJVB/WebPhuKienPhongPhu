	@extends('master')
	@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm {{ $category->name }}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="home">Trang chủ</a> / <span>Loại sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul id="titleAsideMenu">Menu</ul>
						<ul class="aside-menu">

							@foreach( $categories as $item )
							<li><a href=" {{ Route('home.productType',$item->id)}}">{{ $item->name }}</a></li>
							@endforeach
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>Sản phẩm</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{ count($productType) }} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($productType as $item)
								<div class="col-sm-4">
									<div class="single-item">
										@if($item->promotion_price != 0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="{{ route('home.productDetail',$item->id)}}"><img src="upload/products/{{ $item->image }}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{ $item->name }}</p>
											<p class="single-item-price">
												@if($item->promotion_price == 0)
												<span class="flash-sale">{{ number_format($item->unit_price,'0','','.') }}₫</span>
												@else
												<span class="flash-del">{{ number_format($item->promotion_price,'0','','.')}}₫</span>
												<span class="flash-sale">{{ number_format($item->unit_price,'0','','.') }}₫</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{ route('home.productDetail',$item->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach

							</div>
						</div> <!-- .beta-products-list -->

						<div class="space50">&nbsp;</div>

						<div class="beta-products-list">
							<h4>Sản Phẩm Khác</h4>
							<div class="beta-products-details">
								<p class="pull-left">Tìm thấy {{ count($products) }} sản phẩm</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($products as $item)
								<div class="col-sm-4">
									<div class="single-item">
										@if($item->promotion_price != 0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="{{ route('home.productDetail',$item->id)}}"><img src="upload/products/{{ $item->image }}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{ $item->name }}</p>
											<p class="single-item-price">
												@if($item->promotion_price == 0)
												<span class="flash-sale">{{ number_format($item->unit_price,'0','','.') }}₫</span>
												@else
												<span class="flash-del">{{ number_format($item->promotion_price,'0','','.')}}₫</span>
												<span class="flash-sale">{{ number_format($item->unit_price,'0','','.') }}₫</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href="shopping_cart.html"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{ route('home.productDetail',$item->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							<div class="row">{{ $products->links() }}</div>
							
							<div class="space40">&nbsp;</div>
							
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->


			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
	@endsection