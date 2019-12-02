@extends('layouts.main',['title' => '' , 'js'=>'home'])
@section('content')

    <!-- Main charts -->
    <div class="col-lg-12">
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h6 class="panel-title">.</h6>


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
                            <input type="hidden" name="request_id" class="request_id" value="{{$item->request_id}}" />
                        </tr>
                        <tr style="background-color: #f1f1f1" class="hide-td request_{{$item->request_id}}">
                            <td colspan="5" style="text-align: center;"><span style="font-weight: bold">التفاصيل</span></td>
                        </tr>
                        <tr style="background-color: #f6f6f6" class="hide-td request_{{$item->request_id}}">
                            <td colspan="5" style="text-align: center;"><span style="">{{ $item->order_other }}</span></td>
                        </tr>
                        @else
                    @if($item->request_id != $prv_request_id)
                        <?php $prv_request_id = $item->request_id?>
                        <tr class="show-details  ">
                            <td>{{ $key+1 }}</td>
                            <td style="direction: ltr; text-align: center;"><span class="product-name" >{{ $item->phone_number }}</span></td>
                            <td><span class="product-price">
                                 <input type="hidden" name="request_id" class="request_id" value="{{$item->request_id}}" />
                                    {{ $item->address }}</span></td>
                            <td><span class="unit-id" style="color: #e20205">{{ number_format($item->cartTotalCost,2)  }} شيكل</span></td>
                            <td><span class="" style="">{{ $item->created_at }}</span></td>

                        </tr>
                        <tr style="background-color: #f1f1f1" class="hide-td request_{{$item->request_id}}">
                            <td colspan="2"><span style="font-weight: bold">إسم المنتج</span></td>
                            <td><span style="font-weight: bold">السعر</span></td>
                            <td><span style="font-weight: bold">الكمية</span></td>
                            <td><span style="font-weight: bold">التكلفة</span></td>
                        </tr>
                        <tr style="background-color: #f6f6f6" class="hide-td request_{{$item->request_id}}">
                            <td colspan="2" ><span style="">{{ $item->product_name }}</span></td>
                            <td><span style="">{{ $item->product_price }}</span></td>
                            <td><span style="">{{ $item->quantity }}</span></td>
                            <td><span style="">{{ $item->buy_cost }}</span></td>
                        </tr>
                    @else
                        <tr style="background-color: #f6f6f6" class="hide-td request_{{$item->request_id}}">
                            <td colspan="2" ><span style="">{{ $item->product_name }}</span></td>
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


@endsection