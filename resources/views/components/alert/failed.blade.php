@props(['message' => "<strong>Whoops!</strong> There were some problems with your input.", 'errors' => []])

<div class="alert alert-danger alert-dismissible fade show" role="alert">
    
    {!! $message !!}
    @if(!empty($message))
    <br><br>
    @endif

    @if(!empty($errors))
    <ul>
        @foreach ($errors as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
</div>