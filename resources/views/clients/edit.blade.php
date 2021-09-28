@extends('layouts.master')
@section('css')
  @section('title')
  wdit client page
  @stop
@endsection
{{-- start content  --}}
@section('content')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ __('edit client') }}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('edit client') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form action="{{route('clients.update',$client)}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>client name </label>
                                <input type="text"   name="name" value="{{$client->name}}" class="form-control @error('name') is-invalid @enderror" >
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>phone number </label>
                                <input type="text" name="phone[]" class="form-control @error('phone') is-invalid @enderror" value="{{ $client->phone[0] ?? '' }}" >
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label>Another phone number </label>
                                <input type="text" name="phone[]" class="form-control @error('phone') is-invalid @enderror"
                                       value="{{ $client->phone[1] ?? '' }}">
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>address </label>
                                <textarea name="address" class="form-control @error('address') is-invalid @enderror"  >
                                    {{ $client->address }}
                                </textarea>
                                @error('address')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">حفظ البيانات</button>
                        <a href="{{ route('clients.index') }}" class="btn btn-basic"><i class="fa fa-address-card"></i> back to client<a>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection
