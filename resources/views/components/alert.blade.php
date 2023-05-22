<div class="alert alert-{{ $type }} alert-dismissible alert-solid alert-label-icon fade show" style="height:auto;">
    <i class="ri-error-warning-line label-icon"></i><strong>
        @if(gettype($messages) == "object")
        @foreach ($messages->all() as $error)
        {{ $error }}<br>
        @endforeach
        @else
        {{ $messages }}
        @endif
    </strong>
</div>