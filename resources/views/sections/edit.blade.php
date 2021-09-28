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
                    <form action="{{route('sections.update',$section)}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>اسم القسم </label>
                                {{-- <input type="hidden" name="id"   value="{{$section->id}}"> --}}
                                <input type="text"   name="name" value="{{$section->name}}" class="form-control @error('name') is-invalid @enderror" >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">حفظ البيانات</button>
                        <a href="{{ route('sections.index') }}" class="btn btn-basic"><i class="fa fa-address-card"></i> الرجوع الى الاقسام<a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection
