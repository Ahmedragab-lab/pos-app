@extends('layouts.master')
@section('css')
  @section('title')
  orders
  @stop
@endsection
{{-- start content  --}}
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ __('add orders') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('add orders') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6 mb-30">
            <div class="card card-statistics h-100">
              <div class="card-body">
               <h5 class="card-title">sections</h5>
               <div class="accordion gray plus-icon round">
                   @foreach ($sections as $section)
                    <div class="acd-group acd-active">
                        <a href="#" class="acd-heading">{{ $section->name }}</a>
                        <div class="acd-des" style="">
                            <div class="table-responsive">
                                @if($section->products->count()>0)
                                    <table  class="table table-striped table-bordered p-0 text-center table-hover">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>product name</th>
                                            <th>price</th>
                                            <th>stock</th>
                                            <th>Add</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($section->products as $product)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->sale_price}}</td>
                                                <td>{{$product->stock}}</td>
                                                <td><a href="#"
                                                     id="product-{{ $product->id }}"
                                                     data-name="{{ $product->name }}"
                                                     data-id="{{ $product->id }}"
                                                     data-price="{{ $product->sale_price }}"
                                                     class="btn btn-success btn-sm add-product-btn" >
                                                     <i class="fa fa-plus"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                  <h5> {{ __('there is no record') }}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
              </div>
            </div>
        </div>
        {{--  --}}
        <div class="col-xl-6 mb-30">
            <div class="card card-statistics h-100">
                <form action="{{ route('clients\orders.store',$client->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <h5 class="card-title border-0 pb-0">Orders</h5>
                        <div class="table-responsive">
                            <table class="table table-1 table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>Product </th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="order-list">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h4 style="text-align: center;"> Total : <span class="total-price">0</span> </h4>
                    <button  class="btn btn-primary btn-block disabled" id="add-order-form-btn" > <i class="fa fa-plus"></i> Order Now</button>
                </form>
           </div>
        </div>
    </div>
@endsection


@section('js')
<script>
    $(document).ready(function(){
        $('.add-product-btn').on('click',function(){
           var id = $(this).data('id');
           var name = $(this).data('name');
           var price = $(this).data('price');
           $(this).removeClass('btn-success').addClass('btn-default disabled');
           var html = `<tr>
                         <td> ${name} </td>
                         <input type="hidden" name="products[]" value="${id}">
                         <td><input type="number" name="q[]"  data-price="${price}" class="form-control input-small product-q" min="1" value="1"></td>
                         <td class="product-price"> ${price} </td>
                         <td> <button class="btn btn-danger btn-sm remove" data-id="${id}"><i class="fa fa-trash"></i></button></td>
                      </tr>`;
            $('.order-list').append(html);
            calc_total();
         });

         $('body').on('click','.remove',function(e){
             e.preventDefault();
             var id = $(this).data('id');

            $(this).closest('tr').remove();
            $('#product-' + id).removeClass('btn-default disabled').addClass('btn-success');
            calc_total();
         });

         $('body').on('change','.product-q',function(){
             var q = parseInt($(this).val());
            //  var productPrice = parseInt($(this).closest('tr').find('.product-price').html());
            var unitPrice = $(this).data('price');
            $(this).closest('tr').find('.product-price').html(q * unitPrice);
            calc_total();
            //  var totalPrice = q * productPrice ;
            //  $('.total-price').html(totalPrice);
            //   console.log(unitPrice);
         });
    });

    function calc_total(){
       var price = 0;
        $('.order-list .product-price').each(function(){
           price += parseInt($(this).html());
        });
        $('.total-price').html(price);
        //  console.log(price);
        if(price > 0){
          $('#add-order-form-btn').removeClass('disabled');
        }else{
          $('#add-order-form-btn').addClass('disabled');
        }
    }
</script>
@endsection
