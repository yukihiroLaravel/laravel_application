<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>todos</title>
</head>

<body>
    <h1>todoリスト</h1>

    <form action="{{route('todos.store')}}" method="post">
        @csrf
        <input type="text" name="title" placeholder="入力">
        <button type="submit">追加</button>
    </form>

    <ul>
        @foreach($todos as $todo)
        <li>
            <form action="{{route('todos.update',$todo->id)}}" method="post" style="display:inline">
                @csrf
                @method('PATCH')
                <button type="submit" style="text-decoration: {{$todo->is_completed ? 'line-through' : 'none'}}">
                    {{$todo->title}};
                </button>
            </form>
            <form action="{{route('todos.destroy',$todo->id)}}" method="post" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </li>
        @endforeach
    </ul>
</body>

</html>