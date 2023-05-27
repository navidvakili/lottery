@extends('layouts.master')
@section('page_title', 'قرعه کشی')

@section('content')
<x-alert :messages="$errors->any()?$errors:session()->get('message')" />
@if($lottery_default == null)
<div class="alert alert-warning">هنوز قرعه کشی پیش فرضی تعریف نشده است</div>
@else
<div class="box box-primary">
    <div class="box-body">
        <form class="row g-2" method="post" action="{{ route('execute.store') }}">
            @csrf
            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">تعداد افراد شرکت کننده</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="{{ $lottery_default->title }} - {{ $lottery_default->group->members->count() }} نفر">
                </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
                <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">شروع شماره واحد</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control form-control-lg" name="min_vahed" min="1" required autocomplete="off" placeholder="شروع شماره واحد" style="direction:rtl">
                </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
                <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">پایان شماره واحد</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control form-control-lg" name="max_vahed" min="1" required autocomplete="off" placeholder="پایان شماره واحد" style="direction:rtl">
                </div>
            </div>
            <div class="form-group row" style="margin-bottom: 8px;">
                <label for="inputPassword3" class="col-sm-2 col-form-label col-form-label-lg">تعداد افراد</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control form-control-lg" name="num_peoples" min="1" max="{{ $lottery_default->group->members->count() }}" required autocomplete="off" style="direction:rtl" placeholder="تعداد افراد برای قرعه کشی">
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary mb-3 btn-lg">اجرای قرعه کشی</button>
            </div>
        </form>
        @if($lottery_members->count() > 0)
        <div class="table-responsive">
            <a href="{{ route('excel.export', $lottery_default->id) }}" class="btn btn-info">خروجی اکسل</a>
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
        @endif
    </div>
</div>
@endif
@endsection