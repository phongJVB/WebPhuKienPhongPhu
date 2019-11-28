@extends('admin.layouts.index')
@section('content')
<!-- Page Content -->
<div id="page-wrapper" style="padding-top: 5em">
    <div class="container-fluid">
        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
        @foreach($productSale as $item)
            <input type="hidden" name="valueY[]" nameProduct="{{ $item->name }}" value="{{ $item->total_sale_quantity}}">
        @endforeach
    </div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection
@section('script')
<script src="{{ asset('backEnd/dist/js/canvasjs.min.js') }}"></script>
<script type="text/javascript">

window.onload = function () {
    var dps = [] ;
    
    $("input[name='valueY[]']").each(function() {
        dps.push({ y:Number($(this).val()) , label: $(this).attr('nameProduct')});
    });

    var chart = new CanvasJS.Chart("chartContainer", {
        title:{
            text: "Bieu Do Thong Ke San Pham Da Ban"              
        },
        data: [              
        {
            type: "column",
            dataPoints: dps
        }
        ]
    });
    chart.render();
}
</script>
@endsection