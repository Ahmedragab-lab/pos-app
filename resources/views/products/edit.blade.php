@extends('layouts.master')
@section('css')
  @section('title')
  تعديل قسم
  @stop
@endsection
{{-- start content  --}}
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ __('site.dashboard') }}</h4>
            </div>
            <div class="col-sm-6">
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
                    <form action="{{route('products.update',$product)}}" method="post" autocomplete="off" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>product name </label>
                                {{-- <input type="hidden" name="id"   value="{{$product->id}}"> --}}
                                <input type="text"   name="name" value="{{$product->name}}" class="form-control @error('name') is-invalid @enderror" >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>section name</label>
                                <select name="section_id" id="" class="form-control p-1">
                                    @foreach($sections as $section)
                                        <option value="{{$section->id}}" {{$section->id == $product->section_id ? 'selected' : ''}}>{{$section->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>image</label>
                                <input type="file" name="image" value="{{$product->image}}" class="form-control img @error('image') is-invalid @enderror">
                                @error('image')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <img src="{{ asset('uploads/product-img/'.$product->image ) }}" class="img-thumbnail img-preview" width="150" alt="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label>سعر التكلفه</label>
                                <input type="number" name="purchase_price" value="{{$product->purchase_price}}" class="form-control @error('purchase_price') is-invalid @enderror">
                                @error('purchase_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>سعر البيع</label>
                                <input type="number" name="sale_price" value="{{$product->sale_price}}" class="form-control @error('sale_price') is-invalid @enderror">
                                @error('sale_price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>المخزن</label>
                                <input type="number" name="stock" value="{{$product->stock}}" class="form-control @error('stock') is-invalid @enderror">
                                @error('stock')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label>ملاحظات</label>
                            <textarea name="desc" class="form-control" rows="5">{{$product->desc}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success">حفظ البيانات</button>
                        <a href="{{ route('products.index') }}" class="btn btn-basic"><i class="fa fa-address-card"></i> back to products <a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection
