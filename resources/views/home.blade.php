@extends('layouts.main',['title' => '' , 'js'=>'home'])
@section('content')

    <!-- Main charts -->
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">.</h6>
                <a href="/allRequests" class="btn bg-green-400 btn-labeled new-center-btn" style="float:left;margin-top: -25px;">
                    <b><i class=""></i></b> الكل
                </a>

                <div class="heading-elements">

                    <span class="heading-text">الطلبات</span>

                </div>
            </div>

            <div class="panel-body">
                <div id="sales-heatmap"></div>
            </div>

            <table class="table datatable-basic table-bordered dataTable no-footer" id="requests-table">
                <thead>
                <tr>
                    <th>رقم</th>
                    <th>رقم الجوال</th>
                    <th>العنوان</th>
                    <th>تكلفة الطلبية</th>
                    <th>التوقيت</th>
                    <th>عمليات</th>
                </tr>
                </thead>
                <tbody>
                <?php $prv_request_id = 0 ?>
                @foreach($requests as $key => $item)
                    @if($item->is_others  == 1)
                        <tr class="show-details  ">
                            <td>{{ $key+1 }}</td>
                            <td style="direction: ltr; text-align: center;"><span class="product-name" >{{ $item->phone_number }}</span></td>
                            <td><span class="product-price">{{ $item->address }}</span></td>
                            <td><span class="unit-id" style="background-color: #E91E63;color: white;padding: 0px 11px;border-radius: 10px;">طلب نصي</span></td>
                            <td><span class="" style="">{{ $item->created_at }}</span></td>
                            <td class="text-center">

                                <a href="#"  class="certify-request-btn" style="margin: 0px 3px;">
                                    <i class="  icon-check check-icon" style=" color: green;font-size: 18px;"></i>
                                </a>
                                <input type="hidden" name="product_id" class="product_id" value="{{$item->id}}" />
                                <input type="hidden" name="request_id" class="request_id" value="{{$item->request_id}}" />

                            </td>
                        </tr>
                        <tr style="background-color: #f1f1f1" class="hide-td request_{{$item->request_id}}">
                            <td colspan="6" style="text-align: center;"><span style="font-weight: bold">التفاصيل</span></td>
                        </tr>
                        <tr style="background-color: #f6f6f6" class="hide-td request_{{$item->request_id}}">
                            <td colspan="6" style="text-align: center;"><span style="">{{ $item->order_other }}</span></td>
                        </tr>
                        @else
                    @if($item->request_id != $prv_request_id)
                        <?php $prv_request_id = $item->request_id?>
                    <tr class="show-details  ">
                        <td>{{ $key+1 }}</td>
                        <td style="direction: ltr; text-align: center;"><span class="product-name" >{{ $item->phone_number }}</span></td>
                        <td><span class="product-price">{{ $item->address }}</span></td>
                        <td><span class="unit-id" style="color: #e20205">{{ number_format($item->cartTotalCost,2)  }} شيكل</span></td>
                        <td><span class="">{{ $item->created_at }} </span></td>

                        <td class="text-center">

                            <a href="#"  class="certify-request-btn" style="margin: 0px 3px;">
                                <i class="  icon-check check-icon" style=" color: green;font-size: 18px;"></i>
                            </a>
                            <input type="hidden" name="product_id" class="product_id" value="{{$item->id}}" />
                            <input type="hidden" name="request_id" class="request_id" value="{{$item->request_id}}" />

                        </td>
                    </tr>
                        <tr style="background-color: #f1f1f1" class="hide-td request_{{$item->request_id}}">
                            <td colspan="3"><span style="font-weight: bold">إسم المنتج</span></td>
                            <td><span style="font-weight: bold">السعر</span></td>
                            <td><span style="font-weight: bold">الكمية</span></td>
                            <td><span style="font-weight: bold">التكلفة</span></td>
                        </tr>
                       <tr style="background-color: #f6f6f6" class="hide-td request_{{$item->request_id}}">
                           <td colspan="3"><span style="">{{ $item->product_name }}</span></td>
                           <td><span style="">{{ $item->product_price }}</span></td>
                           <td><span style="">{{ $item->quantity }}</span></td>
                           <td><span style="">{{ $item->buy_cost }}</span></td>
                       </tr>
                    @else
                        <tr style="background-color: #f6f6f6" class="hide-td request_{{$item->request_id}}">
                            <td colspan="3"><span style="">{{ $item->product_name }}</span></td>
                            <td><span style="">{{ $item->product_price }}</span></td>
                            <td><span style="">{{ $item->quantity }}</span></td>
                            <td><span style="">{{ $item->buy_cost }}</span></td>
                        </tr>
                     @endif
                    @endif
                @endforeach


                </tbody>
            </table>


        </div>
    </div>

    <style>
        #requests-table tr td, #requests-table tr th{
        padding: 5px !important;
        }
    </style>

    <script>

             var myVar;
             var thereOneRequest = false;
             $(document).on('mouseover ',function(){
                 clearInterval(myVar);
                 $('.title-home').text('Click Shop');
                 thereOneRequest = false;
             })
             var audio = new Audio('{{ asset('uploads/sound.mp3') }}');
             var table_length = $('#requests-table tbody tr').length;

             function getData(){
                 var base_url = 'http://' + window.location.host+'/';
console.log('lll')
                 $.ajax({
                     type: 'get',
                     dataType: "json",
                     url: base_url+ 'sse_notifications',
                     data: "",
                     cache: "false",
                     success: function(data) {
                         if($('#requests-table tbody tr').length == 0){
                             $('#requests-table tbody').html(data['notifications']);
                         }else{
                             $('#requests-table tbody tr:first').before((data['notifications']));
                         }


                         if(table_length !== $('#requests-table tbody tr').length){

                             console.log(table_length+' - '+$('#requests-table tbody tr').length)
                             var counter = 0;
                             if(!thereOneRequest){
                                 myVar =  setInterval(function(){
                                     if(counter % 2 == 0){
                                         $('.title-home').text('طلب جديد')
                                     }else{
                                         $('.title-home').text('Click Shop')
                                     }
                                     counter++;
                                 },1000);
                             }
                             audio.play();

                             thereOneRequest = true;
                             table_length = $('#requests-table tbody tr').length;
                         }
                     }

                 });
                 return false;

             }
             setInterval(function(){
                 var base_url = 'http://' + window.location.host+'/';
                 console.log('lll')
                 $.ajax({
                     type: 'get',
                     dataType: "json",
                     url: base_url+ 'sse_notifications',
                     data: "",
                     cache: "false",
                     success: function(data) {
                         if($('#requests-table tbody tr').length == 0){
                             $('#requests-table tbody').html(data['notifications']);
                         }else{
                             $('#requests-table tbody tr:first').before((data['notifications']));
                         }


                         if(table_length !== $('#requests-table tbody tr').length){

                             console.log(table_length+' - '+$('#requests-table tbody tr').length)
                             var counter = 0;
                             if(!thereOneRequest){
                                 myVar =  setInterval(function(){
                                     if(counter % 2 == 0){
                                         $('.title-home').text('طلب جديد')
                                     }else{
                                         $('.title-home').text('Click Shop')
                                     }
                                     counter++;
                                 },1000);
                             }
                             audio.play();

                             thereOneRequest = true;
                             table_length = $('#requests-table tbody tr').length;
                         }
                     }

                 });
                 return false;
             },3000);



    </script>
@endsection