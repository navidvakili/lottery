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
            <div class="col-auto">
                <label for="staticEmail2" class="visually-hidden">عنوان</label>
                <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="{{ $lottery_default->title }} - {{ $lottery_default->group->members->count() }} نفر">
            </div>
            <div class="col-2">
                <label for="inputPassword2" class="visually-hidden">شروع شماره واحد</label>
                <input type="number" class="form-control" name="min_vahed" min="1" required autocomplete="off" placeholder="شروع شماره واحد" style="direction:rtl">
            </div>
            <div class="col-2">
                <label for="inputPassword2" class="visually-hidden">پایان شماره واحد</label>
                <input type="number" class="form-control" name="max_vahed" min="1" required autocomplete="off" placeholder="پایان شماره واحد" style="direction:rtl">
            </div>
            <div class="col-3">
                <label for="inputPassword3" class="visually-hidden">تعداد افراد</label>
                <input type="number" class="form-control" name="num_peoples" min="1" max="{{ $lottery_default->group->members->count() }}" required autocomplete="off" style="direction:rtl" placeholder="تعداد افراد برای قرعه کشی">
            </div>

            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">اجرای قرعه کشی</button>
            </div>
        </form>

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
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@endsection