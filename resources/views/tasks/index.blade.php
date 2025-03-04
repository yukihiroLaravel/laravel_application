<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todoリスト</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body class="bg-gray-100">
    <div class="container mx-auto p-6 bg-white rounded shadow-md">
      <nav class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold mb-4">Todoリスト</h1>
        <a href="{{ route('tasks.trash') }}" class="text-blue-500 underline">ゴミ箱</a>
      </nav>
      <form action="{{ route('tasks.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-2">
          <div>
            <label for="task_name" class="text-xs">タスク</label>
            <input type="text" name="task_name" id="task_name" class="border border-gray-300 p-2 my-2 w-48">
          </div>
          <div>
            <label for="due_time" class="text-xs">期限</label>
            <input type="datetime-local" name="due_time" value="{{ now()->format('Y-m-d\TH:i') }}" class="border p-2 w-full">
          </div>
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">追加</button>
        </div>
      </form>
    </div>
    <ul class="list-none mx-auto pl-0 text-sm w-2/3">
      @foreach ($tasks as $task)
        <li class="li class="flex justify-between items-center bg-white p-3 rounded shadow mb-2 gap-4">
          <div class="flex-grow">
            <span class="text-gray-800 font-medium">{{ $task->task_name }}:</span>
            <span class="text-gray-500">{{ date('Y-m-d H:i', strtotime($task->due_date)) }}</span>
          </div>
          <form action="{{ route('tasks.markAsDeleted', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 shadow-md">Done!</button>
          </form>
        </li>
      @endforeach
    </ul>
  </body>
</html>