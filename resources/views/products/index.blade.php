@extends('layouts.master')
@section('css')
  @section('title')
      المنتجات
  @stop
@endsection
{{-- start content  --}}
@section('content')
@include('partial.error')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> Products <strong style="color:rgb(240, 126, 20)">{{ $products->total() }}</strong> </h4>
            </div>
            <div class="col-sm-3">
                <h4 class="mb-0"> Sections <strong style="color:rgb(226, 29, 29)">{{ $sections->count() }}</strong> </h4>
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('site.dashboard') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form action="{{route('products.index')}}" method="GET">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="search" class="form-control" placeholder="بحث" value="{{ request()->search }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <select name="section_id" id="" class="form-control" style="padding: 12px;">
                                    <option value="">All sectiions</option>
                                   @foreach ($sections as $section)
                                         <option value="{{ $section->id }}" {{ request()->section_id == $section->id ? 'selected':'' }} >{{ $section->name }}</option>
                                   @endforeach
                                </select>
                            </div>

                            <div class="col-md-1 mb-3">
                               <button type="submit" class="btn btn-success" style="padding:10px;"><i class="fa fa-search"></i> Search</button>
                            </div>
                            <div class="col-md-5 mb-3">
                               <button  class="btn btn-basic" style="padding:10px;"> Show All products</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col mb-3">
                            <a href="{{route('products.create')}}" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-plus"></i> اضافه منتج جديد</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم المنتج</th>
                                <th>اسم القسم</th>
                                <th>image</th>
                                <th>سعر التكلفه</th>
                                <th>سعر البيع</th>
                                <th>المكسب</th>
                                <th>نسبه الارباح %</th>
                                <th>المخزن</th>
                                <th>ملاحظات</th>
                                <th>العمليات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->section->name}}</td>
                                    <td><img src="{{ asset('uploads/product-img/'.$product->image) }}" class="img-thumbnail" width="100" alt=""></td>
                                    <td>{{$product->purchase_price}}</td>
                                    <td>{{$product->sale_price}}</td>
                                    <td>{{$product->profit}}</td>
                                    <td>{{$product->profit_percent}} %</td>
                                    <td>{{$product->stock}}</td>
                                    <td>{{$product->desc == true ? $product->desc : 'لا توجد ملاحظات'}}</td>
                                    <td>
                                        <form action="{{route('products.destroy',$product)}}" method="post">
                                            {{method_field('delete')}}
                                            {{csrf_field()}}
                                            <a href="{{route('products.edit',$product)}}"
                                                class="btn btn-info btn-sm" title="تعديل" role="button" aria-pressed="true" ><i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm "
                                                onclick="confirm('{{ __("هل انت متاكد من عملية حذف المنتج ؟") }}') ? this.parentElement.submit() : ''" >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- delete -->

            </div>
        </div>
    </div>
@endsection

@section('js')
{{-- <script>
    $('#deletedproduct').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var pro_id = button.data('pro_id')
        var modal = $(this)
        modal.find('.modal-body #pro_id').val(pro_id);
    })
</script> --}}
@endsection
