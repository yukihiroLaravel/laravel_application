<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>チャットアプリ-{{ $chatRoom->name }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  </head>
  <body class="bg-blue-100">
    <div class="container mx-auto p-2">
      <h1 class="text-xl font-bold text-gray-700">{{ $chatRoom->name }}</h1>
      <div id="messages" class="bg-white h-96 overflow-scroll mb-6 p-2"></div>
      <form id="message-form" class="space-y-4">
        <input type="hidden" name="chat_room_id" value="{{ $chatRoom->id }}">
      <div>
        <div><label for="nickname" class="text-gray-700 mb-2 text-xs">名前</label></div>
        <input type="text" name="nickname" id="nickname" required maxlength="8" placeholder="suzuki" class="p-1 rounded shadow">
      </div>
      <div>
      <div><label for="message" class="text-gray-700 mb-2 text-xs">メッセージ</label></div>
        <textarea name="message" id="message" rows="3" required class="w-full border border-gray-300 p-1 rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
      </div>
      <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-700 w-auto inline-block">送信</button>
      </form>
    </div>
    <script>
      document.getElementById('message-form').addEventListener('submit', async (event) => {
        event.preventDefault();
        
        const formData = new FormData(document.getElementById('message-form'));

        try {
          const response = await fetch('{{ route('messages.store') }}', {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              'Accept': 'application/json'
            },
            body: formData
          });

          if (!response.ok) {
            const errorText = await response.text();
            console.error('サーバーレスポンスエラー:', errorText);
            throw new Error('サーバーエラーが発生しました。');
          }

          const data = await response.json();

          // if (data.status !== 'success') {
          //   console.error('サーバーエラー:', data);
          //   alert('メッセージの送信に失敗しました');
          //   return;
          // }

          // メッセージを表示
          const messageDiv = document.createElement('div');
          messageDiv.classList.add('flex', 'justify-end');

          const newMessage = document.createElement('div');


          newMessage.classList.add('max-w-xs', 'bg-blue-500', 'text-white', 'p-4', 'rounded-lg', 'shadow-lg', 'mb-3');
          newMessage.innerHTML = `
            <p class="text-sm font-semibold">${data.nickname}</p>
            <p>${data.message}</p>
          `;

          messageDiv.appendChild(newMessage);
          document.getElementById('messages').appendChild(messageDiv);

          // 入力欄をクリア
          document.getElementById('message').value = '';

          // スクロールを最下部に移動
          document.getElementById('messages').scrollTop = document.getElementById('messages').scrollHeight;

        } catch (e) {
          console.error(e.message);
          alert('エラーが発生しました。');
        }
      });

      // メッセージの表示
      function loadMessages() {
        fetch('{{ route('messages.index', $chatRoom->id) }}')
          .then(response => response.json())
          .then(data => {
            const messageDiv = document.getElementById('messages');
            messageDiv.innerHTML = '';
            data.forEach(message => {
              const newMessage = document.createElement('div');
              const formatData = new Date(message.created_at).toLocaleString();

              newMessage.classList.add('flex', 'justify-start', 'items-end', 'mb-3');

              newMessage.classList.add('flex', 'justify-start');

              newMessage.innerHTML = `
                <div class="max-w-xs bg-gray-200 text-gray-800 mt-4 p-4 rounded-lg shadow-lg w-48">
                  <p class="text-xs text-gray-400 font-semibold">${message.nickname}</p>
                  <p>${message.message}</p>
                </div>
                <p class="text-xs text-gray-500 ml-2">${formatData}</p>
              `;
              messageDiv.appendChild(newMessage);
            });
            messageDiv.scrollTop = messageDiv.scrollHeight;
          })
          .catch(error => console.error('メッセージ取得エラー:', error));
      }

      loadMessages();
      setInterval(loadMessages, 5000);
    </script>
  </body>
</html>