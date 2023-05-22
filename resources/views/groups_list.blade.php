@extends('layouts.master')
@section('page_title', 'فهرست گروه ها')

@section('content')
<x-alert :messages="$errors->any()?$errors:session()->get('message')" />
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="float-end">
                    <a href="{{ route('groups.create') }}" class="btn btn-info">جدید</a>
                </div>
            </div>
            <div class="card-body">
                <!-- <p class="card-title">Add class <code>.table-striped</code> inside table element</p> -->
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ردیف</th>
                                <th>عنوان گروه</th>
                                <th>وضعیت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($key=0)
                            @foreach ($groups as $item)
                            <tr>
                                <td>{{ $groups->firstItem() + $key }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <a href="{{ route('groups.edit', $item->id) }}">ویرایش</a> |
                                    <a href="{{ route('groups.index') }}" onclick="event.preventDefault(); if(confirm('آیا از حذف مطمئن هستید?')){
                                                                                                                document.getElementById(
                                                                                                                  'delete-form-{{ $item->id }}').submit();}">
                                        حذف
                                    </a>
                                </td>
                                <form id="delete-form-{{ $item->id }}" + action="{{ route('groups.destroy', $item->id) }}" method="post">
                                    @csrf @method('DELETE')
                                </form>
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