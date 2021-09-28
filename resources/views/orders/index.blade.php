@extends('layouts.master')
@section('css')
  @section('title')
       الاقسام
  @stop
@endsection
{{-- start content  --}}
@section('content')
@include('partial.error')
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{ __('  الاقسام') }} <strong style="color: rgb(243, 154, 53)">{{ $sections->count() }}</strong>  </h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right">
                    <li class="breadcrumb-item"><a href="#" class="default-color">Home</a></li>
                    <li class="breadcrumb-item active">{{ __('  الاقسام') }} </li>
                </ol>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <form action="{{route('sections.index')}}" method="GET">
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
                            <a href="{{route('sections.create')}}" class="btn btn-success" role="button" aria-pressed="true"><i class="fa fa-plus"></i> اضافه قسم جديد</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="datatable" class="table table-striped table-bordered p-0 text-center table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>section name</th>
                                <th>product number</th>
                                <th>product </th>
                                <th>action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sections as $section)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$section->name}}</td>
                                    <td>{{$section->products->count()}}</td>
                                    <td><a href="{{ route('products.index',['section_id'=> $section->id]) }}" class="btn btn-info btn-sm">products section</a></td>
                                    <td>
                                        <form action="{{route('sections.destroy',$section)}}" method="post">
                                            {{method_field('delete')}}
                                            {{csrf_field()}}
                                            <a href="{{route('sections.edit',$section)}}"
                                                class="btn btn-info btn-sm" title="تعديل" role="button" aria-pressed="true" ><i class="fa fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm "
                                                onclick="confirm('{{ __("هل انت متاكد من عملية حذف القسم ؟") }}') ? this.parentElement.submit() : ''" >
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
