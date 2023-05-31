@extends('layouts.master')
@section('page_title', 'بارگذاری قرعه کشی')

@section('content')
<x-alert :messages="$errors->any()?$errors:session()->get('message')" />
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <!-- <div class="card-header">Basic Form</div> -->
            <div class="card-body">
                <form accept-charset="utf-8" action="{{ route('lottery.excel.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">عنوان قرعه کشی (از این عنوان در متن پیامک استفاده خواهد شد)</label>
                        <input type="text" name="title" placeholder="عنوان قرعه کشی را وارد کنید" autocomplete="off" class="form-control" required="" value="{{old('value')}}">
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">فایل اکسل (دارای چهار ستون به ترتیب: شماره ملی، نام و نام خانوادگی، شماره موبایل و شماره واحد)</label>
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