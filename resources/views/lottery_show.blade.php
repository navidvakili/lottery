@extends('layouts.master')
@section('page_title', 'نتایج قرعه کشی ::'.$lottery->title)

@section('content')
<x-alert :messages="$errors->any()?$errors:session()->get('message')" />
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header">
               
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
                                <th>شماره واحد</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($key=0)
                            @foreach ($lottery_members as $item)
                            <tr>
                                <td>{{ $lottery_members->firstItem() + $key }}</td>
                                <td>{{ $item->client->nationalcode }}</td>
                                <td>{{ $item->client->name }}</td>
                                <td>{{ $item->vahed }}</td>
                            </tr>
                            @php($key++)
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {!! $lottery_members->links( "pagination::bootstrap-4") !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection