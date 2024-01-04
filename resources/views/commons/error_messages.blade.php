@if (count($errors) > 0)
    <ul calss="alert alert-danger" role="alert">
        @foreach ($errors->all() as $error)
            <ti class="ml-4">{{ $error }}</ti>
        @endforeach
    </ul>
@endif