@if (count($errors) > 0)
<ul class="alert alert-danger" role="alert">
  @foreach ($errors->all() as $error)
  <li class="ml-4">{{ $error }}</li>
  @endforeach
</ul>
@endif

{{-- ここの「$error」の部分は、「echo $error」のように変数の中身を表示する意味合い
さらに、JavaScriptなどの悪意のあるコードが {{ }} の中に含まれていたとしても、
JavaScriptなどのコードとしては処理されず、安心して表示させることができる--}}
{{-- ul は「箇条書きリスト」を作成するためのタグ   --}}