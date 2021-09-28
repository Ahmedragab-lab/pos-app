@extends('layouts.master')
@section('css')
  @section('title')
       clients
  @stop
@endsection
{{-- start content  --}}
@section('content')
@include('partial.error')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ __('clients') }} <strong style="color: rgb(243, 154, 53)">{{ $clients->count() }}</strong> </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('clients') }}</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form action="{{route('clients.index')}}" method="GET">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <input type="text" name="search" class="form-control" placeholder="بحث" >
                            </div>
                            <div class="col-md-1 mb-3">
                               <button type="submit" class="btn btn-success" style="padding:10px;"><i class="fa fa-search"></i> Search</button>
                            </div>
                            <div class="col-md-5 mb-3">
                               <button  class="btn btn-basic" style="padding:10px;"> Show All Sections</button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col mb-3">
                            <a href="{{route('clients.create')}}" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-plus"></i> add new client</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>client name</th>
                                <th>phone number</th>
                                <th>address </th>
                                <th>make order</th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$client->name}}</td>
                                    {{-- <td>{{implode(array_filter($client->phone), '-') }}</td> --}}
                                    <td>{{implode('-',$client->phone)}}</td>
                                    <td>{{$client->address}}</td>
                                    @can('order-create')
                                       <td><a href="{{ route('clients\orders.create',$client->id) }}" class="btn btn-info btn-sm"><i class="fa fa-shopping-basket"></i> make order</a> </td>
                                    @else
                                       <td><a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-shopping-basket"></i> make order</a> </td>
                                    @endcan
                                    <td>
                                        <form action="{{route('clients.destroy',$client)}}" method="post">
                                            {{method_field('delete')}}
                                            {{csrf_field()}}
                                            <a href="{{route('clients.edit',$client)}}"
                                                class="btn btn-info btn-sm" title="تعديل" role="button" aria-pressed="true" ><i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm "
                                                onclick="confirm('{{ __("Are You Sure To Delete This Client ? ") }}') ? this.parentElement.submit() : ''" >
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
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
