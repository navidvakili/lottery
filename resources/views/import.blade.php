@extends('layouts.master')
@section('page_title', 'قرعه کشی جدید')

@section('content')
<x-alert :messages="$errors->any()?$errors:session()->get('message')" />
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <!-- <div class="card-header">Basic Form</div> -->
            <div class="card-body">
                <form accept-charset="utf-8" action="{{ route('excel.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="groups" class="form-label">گروه متقاضیان</label>
                        <select name="group" id="groups" class="form-select" required="">
                            <option value="" selected="">یک گزینه را انتخاب کنید</option>
                            @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">فایل اکسل (دارای دو ستون به ترتیب: شماره ملی، نام و نام خانوادگی)</label>
                        <input type="file" name="file" class="form-control" required="" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">بارگذاری</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection