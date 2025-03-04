<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todoリスト-ゴミ箱</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  </head>
  <body class="bg-gray-300">
    <div class="container mx-auto p-4">
      <nav class="flex justify-between">
        <h1 class="text-2xl font-bold mb-4">ゴミ箱</h1>
        <a href="{{ route('tasks.index') }}" class="border border-blue-500 hover:bg-blue-700 hover:text-white p-2 mb-2 round">TOP</a>
      </nav>
      <ul class="list-disc pl-5">
        @foreach ($tasks as $task)
          <li class="flex justify-between items-center bg-white p-3 rounded shadow mb-2">
          <div class="flex items-center gap-4">  
              <p class="task-name">{{ $task->task_name }}</p>
                <form action="{{ route('tasks.recover', $task->id) }}" method="POST" class="mb-4">
                  @csrf
                  @method('PUT')
                  <button type="button" onclick="recoverTask()" class="recover-btn">復元</button>
                </form>
            </div>
          </li>
        @endforeach
        @if(count($tasks) > 0)
          <div class="text-center mt-6">
            <form action="{{ route('tasks.deleteTrash') }}" method="POST" class="mb-4">
              @csrf
              @method('DELETE')
              <button type="button" onclick="permanentDelete()" class="delete-btn">ゴミ箱を空にする</button>
            </form>
          </div>
        @endif
      </ul>
      @if($tasks->isEmpty())
        <p class="text-center text-gray-600 mt-4">ゴミ箱は空です。</p>
      @endif
    </div>
  </body>
  <script>
    function recoverTask() {
      if (confirm('このタスクを復元しますか？')) {
        event.target.form.submit();
      }
    }
    function permanentDelete() {
      if (confirm('ゴミ箱を空にしますか？')) {
        event.target.form.submit();
      }
    }
  </script>
</html>
