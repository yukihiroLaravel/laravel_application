<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>天気アプリ-TOP</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
  </head>
  <body>
    <div class="wrap flex items-center justify-center h-screen bg-gray-300">
      <div class="container mx-auto p-4 w-64 bg-white shadow-bg rounded-md">
        <div>
        <svg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
            <!-- 太陽 -->
            <circle cx="50" cy="30" r="12" fill="yellow" stroke="orange" stroke-width="2"/>
            
            <!-- 太陽の光 -->
            <g stroke="orange" stroke-width="2">
              <line x1="50" y1="5" x2="50" y2="15"/>
              <line x1="50" y1="45" x2="50" y2="55"/>
              <line x1="25" y1="30" x2="35" y2="30"/>
              <line x1="65" y1="30" x2="75" y2="30"/>
              <line x1="35" y1="15" x2="40" y2="20"/>
              <line x1="65" y1="15" x2="60" y2="20"/>
              <line x1="35" y1="45" x2="40" y2="40"/>
              <line x1="65" y1="45" x2="60" y2="40"/>
            </g>
            
            <!-- 雲（もくもくした形）-->
            <g fill="lightgray" stroke="gray" stroke-width="2">
              <circle cx="55" cy="65" r="12"/>
              <circle cx="45" cy="68" r="10"/>
              <circle cx="65" cy="68" r="10"/>
              <ellipse cx="55" cy="72" rx="18" ry="10"/>
            </g>
          </svg>
        </div>
        <h1 class="text-2xl font-bold mb-4">天気予報-{{ $city }}</h1>
        <select name="city" id="city-selector" class="mb-4 p-2 border border-gray-300 rounded">
          @foreach ($cities as $c)
            <option value="{{ $c['english_name'] }}" @if($c['english_name'] == $city) selected @endif>
            {{ $c['kanji_name'] }}</option>
          @endforeach
        </select>
        <div>
          <p>時刻： {{ date('Y-m-d H:i', strtotime($weatherDate['current']['time'])) }}</p>
          <p>気温： {{ $weatherDate['current']['temperature_2m'] }}°</p>
          <p>風速： {{ $weatherDate['current']['wind_speed_10m'] }} m/s</p>
        </div>
        <button type="button" class="bg-blue-500 text-white p-2 mt-2 rounded" onclick="openModal()">詳細を見る</button>
      </div>
      <div id="weatherModal" class="fixed insert-0 hidden">
        <div class="flex items-center justify-center h-screen">
          <div class="bg-gray-100 rounded-lg shadow-lg w-80 max-md:w-96 overflow-y-auto p-4">
            <div class="flex items-center justify-between border-b pb-2">
              <h2 class="text-xl font-bold">詳細な天気データ</h2>
                <button type="button" class="text-gray-600 hover:text-gray-800" onclick="closeModal()">&times;</button>
            </div>
            <div class="mt-4 overflow-scroll h-52">
              <ul>
                @foreach ($weatherDate['hourly']['time'] as $index => $hourlyTime)
                  <li class="border-b py-2">
                    <span class="font-bold">
                      {{ date('Y-m-d H:i', strtotime($hourlyTime)) }}
                      : {{ $weatherDate['hourly']['temperature_2m'][$index] }}°
                    </span>
                  </li>
                 @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      document.getElementById('city-selector').addEventListener('change', async (event) => {
        const city = event.target.value;
        window.location.href = `/weather?city=${city}`
      });

      function openModal() {
        console.log('詳細データ');
        document.getElementById
        ('weatherModal').classList.remove
        ('hidden');
      }
      function closeModal() {
        document.getElementById
        ('weatherModal').classList.add
        ('hidden');
      }
    </script>
  </body>
</html>