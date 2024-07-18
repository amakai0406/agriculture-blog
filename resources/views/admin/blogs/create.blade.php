@section('content')
<div class="container">
    <h1>ブログ記事作成</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}"
                style="font-size: 1.25rem; width: 80%;" required>
        </div>

        <div class="form-group">
            <label for="eyecatch_image">アイキャッチ画像</label>
            <input type="file" name="eyecatch_image" id="eyecatch_image" class="form-control-file">
            <div id="eyecatch_image_preview" class="mt-2"></div>
        </div>

        <div class="form-group">
            <label for="content">内容</label>
            <div id="content" contenteditable="true"
                class="form-control cke_editable cke_editable_themed cke_contents_ltr" spellcheck="false"
                aria-label="本文を入力してください" aria-required="true"
                style="height: 450px; overflow: auto; border: 1px solid #ccc; padding: 10px;">

            </div>
            <input type="hidden" name="content_hidden" id="content_hidden">
        </div>

        <div class="form-group">
            <label for="content_images">本文画像</label>
            <input type="file" name="content_images[]" id="content_images" class="form-control-file" multiple>
        </div>

        <div id="image-preview-container" class="mb-3"></div>

        <button type="submit" class="btn btn-primary">作成</button>
    </form>
</div>

<script>
    document.getElementById('eyecatch_image').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const previewContainer = document.getElementById('eyecatch_image_preview');
        previewContainer.innerHTML = '';

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.classList.add('img-thumbnail');
                imgElement.style.maxWidth = '200px';
                previewContainer.appendChild(imgElement);
            };

            reader.readAsDataURL(file);
        }
    });

    document.getElementById('content_images').addEventListener('change', function (event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = '';

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function (e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.classList.add('img-thumbnail', 'mr-2');
                imgElement.style.maxWidth = '150px';

                const insertButton = document.createElement('button');
                insertButton.type = 'button';
                insertButton.classList.add('btn', 'btn-secondary', 'ml-2');
                insertButton.textContent = `Insert Image ${i + 1}`;
                insertButton.addEventListener('click', function () {
                    const imgHTML = `<img src="${e.target.result}" alt="Content Image" class="img-fluid">`;
                    const selection = window.getSelection();
                    if (!selection.rangeCount) return false;
                    const range = selection.getRangeAt(0);
                    range.deleteContents();
                    const tempDiv = document.createElement('div');
                    tempDiv.innerHTML = imgHTML;
                    const frag = document.createDocumentFragment();
                    let child;
                    while ((child = tempDiv.firstChild)) {
                        frag.appendChild(child);
                    }
                    range.insertNode(frag);
                });

                const div = document.createElement('div');
                div.classList.add('mb-2');
                div.appendChild(imgElement);
                div.appendChild(insertButton);

                previewContainer.appendChild(div);
            };

            reader.readAsDataURL(file);
        }
    });

    document.querySelector('form').addEventListener('submit', function () {
        document.getElementById('content_hidden').value = document.getElementById('content').innerHTML;
    });
</script>