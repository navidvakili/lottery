@extends('layouts.master')
@section('page_title', 'قرعه کشی جدید')

@section('content')
<x-alert :messages="$errors->any()?$errors:session()->get('message')" />
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <!-- <div class="card-header">Basic Form</div> -->
            <div class="card-body">
                <form accept-charset="utf-8" action="{{ route('lottery.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">عنوان</label>
                        <input type="text" name="title" placeholder="عنوان گروه را وارد کنید" autocomplete="off" class="form-control" required="">
                    </div>
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
                        <button type="submit" class="btn btn-primary">ثبت</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection