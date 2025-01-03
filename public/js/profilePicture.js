document.getElementById('profile_picture').addEventListener('change', function (event) {
    const formData = new FormData();
    formData.append('profile_picture', event.target.files[0]);

    fetch("{{ route('profile.uploadTemp') }}", {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const previewDiv = document.getElementById('profile-picture-preview');
                previewDiv.innerHTML = `
    <img src="${data.imageUrl}" alt="アップロードされたプロファイル写真" style="max-width: 150px; max-height: 150px;">
        <button type="button" class="btn btn-danger mt-2" onclick="deletePicture()">写真を削除</button>
        `;
            } else {
                alert(data.error || 'アップロードに失敗しました');
            }
        })
        .catch(error => console.error('Error:', error));
});

function deletePicture() {
    fetch("{{ route('profile.deleteTemp') }}", {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const previewDiv = document.getElementById('profile-picture-preview');
                previewDiv.innerHTML = ''; // プレビューをクリア
            } else {
                alert(data.error || '削除に失敗しました');
            }
        })
        .catch(error => console.error('Error:', error));
}