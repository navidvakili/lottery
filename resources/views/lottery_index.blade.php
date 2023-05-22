@extends('layouts.master')
@section('page_title', 'فهرست قرعه کشی ها')

@section('content')
<x-alert :messages="$errors->any()?$errors:session()->get('message')" />
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <a href="{{ route('lottery.create') }}" class="btn btn-info">جدید</a>
                </div>
            </div>
            <div class="card-body">
                <!-- <p class="card-title">Add class <code>.table-striped</code> inside table element</p> -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>عنوان قرعه کشی</th>
                                <th>نام گروه</th>
                                <th>پیش فرض</th>
                                <th>وضعیت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($key=0)
                            @foreach ($lottery as $item)
                            <tr>
                                <td>{{ $lottery->firstItem() + $key }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->group->title }}</td>
                                <td><a href="{{ route('lottery.default', $item->id) }}" onclick="return confirm('آیا از تغییر پیش فرض مطمئن هستید?')"><i class="fa fa-{{ ($item->default == 0)?'times':'check' }}"></i></td>
                                <td>
                                    <a href="{{ route('lottery.edit', $item->id) }}">ویرایش</a> |
                                    <a href="{{ route('lottery.show', $item->id) }}">نتایج</a> |
                                    <a href="{{ route('lottery.index') }}" onclick="event.preventDefault(); if(confirm('آیا از حذف مطمئن هستید?')){
                                                                                                                document.getElementById(
                                                                                                                  'delete-form-{{ $item->id }}').submit();}">
                                        حذف
                                    </a>
                                </td>
                                <form id="delete-form-{{ $item->id }}" + action="{{ route('lottery.destroy', $item->id) }}" method="post">
                                    @csrf @method('DELETE')
                                </form>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $lottery->links( "pagination::bootstrap-4") !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection