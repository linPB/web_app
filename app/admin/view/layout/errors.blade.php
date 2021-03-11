@if(isset($errors))
    <div class="alert alert-danger" role="alert"  style="list-style-type:none;">
        @foreach($errors as $error)
            <li>{{$error}}</li>
        @endforeach
    </div>
@endif