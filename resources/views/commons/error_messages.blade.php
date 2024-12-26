@if (count($errors) > 0)
    <ul class="alert alert-danger" style="max-width: 400px; margin: 0 auto; padding: 10px; border: 1px; margin-bottom: 20px; text-align: left;" role="alert" >
        @foreach ($errors->all() as $error)
            <li class="ml-4">{{ $error }}</li>
        @endforeach
    </ul>
@endif