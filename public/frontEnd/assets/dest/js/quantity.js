$(document).ready(function(){
	$('.minus-btn').on('click', function(e) {
		e.preventDefault();
		var $this = $(this);
		var $mode = $(this).attr("mode");
		var $input = $this.next('input');
		var value = parseInt($input.val());
		
		if ( value > 1 ) {
			value = value - 1;
		} else if( $mode==2 ){
			alert('Bạn có chắc chắn xóa sản phẩm không ?');
			value = 0;
		}else{
			value = 1;
		}
		
		$input.val(value);
		
	});
	
	$('.plus-btn').on('click', function(e) {

		e.preventDefault();
		var $this = $(this);
		var $input = $this.prev('input');
		var value = parseInt($input.val());
		var stockQty = parseInt($('#inputQty').attr("stockQty"));
		
		if ( value < stockQty ) {
			value = value + 1;
		} else {
			value = stockQty;
		}
		
		$input.val(value);
	});

	$('#inputQty').on('change',function(){

			 		var value = parseInt($(this).val());
			 		var stockQty = parseInt($('#inputQty').attr("stockQty"));
			 		debugger;
			 		var $mode = $(this).attr("mode");

			 		if( (value < 1 || isNaN(value)) && $mode ==1 ){
			 			value = 1;
			 		}else if( (value < 1 || isNaN(value)) && $mode ==2 ){
			 			alert('Bạn có chắc chắn xóa sản phẩm không ?');
			 			value = 0;
			 		}else if(value > stockQty){
			 			value = stockQty;
			 		}else{
			 			value = value;
			 		}
			 		 $(this).val(value);
			 	});

			 	$('#inputQty').on('keypress',function(evt){
					if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57){
					    evt.preventDefault();
					}
			 	});
})