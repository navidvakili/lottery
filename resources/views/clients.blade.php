@extends('layouts.master')
@section('page_title', 'فهرست متقاضیان :: '.$group->title)

@section('content')
<x-alert :messages="$errors->any()?$errors:session()->get('message')" />
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                </div>
            </div>
            <div class="card-body">
                <!-- <p class="card-title">Add class <code>.table-striped</code> inside table element</p> -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>شماره ملی</th>
                                <th>نام و نام خانوادگی</th>
                                <th>وضعیت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($key=0)
                            @foreach ($clients as $item)
                            <tr>
                                <td>{{ $clients->firstItem() + $key }}</td>
                                <td>{{ $item->nationalcode }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <a href="{{ route('clients.index', $group->id) }}" onclick="event.preventDefault(); if(confirm('آیا از حذف مطمئن هستید?')){
                                                                                                                document.getElementById(
                                                                                                                  'delete-form-{{ $item->id }}').submit();}">
                                        حذف
                                    </a>
                                </td>
                                <form id="delete-form-{{ $item->id }}" + action="{{ route('clients.destroy', $item->id) }}" method="post">
                                    @csrf @method('DELETE')
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                {!! $clients->links( "pagination::bootstrap-4") !!}
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection