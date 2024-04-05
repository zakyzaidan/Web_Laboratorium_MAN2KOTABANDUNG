<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input materi</title>
    <!-- Font Awesome 5.15.4 -->
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/style-materi-add-update.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
</head>
<body>
    <h1>Form Input Data</h1>
    <form>
        <div class="form-group">
            <label for="thumbnail">Thumbnail Materi</label>
            <div class="thumbnail">
                <div class="input">
                    <img id="image-preview" src="image/image-default.png" alt="Preview Image">
                    <div class="foto">
                        <p>Unggah Thumbnail materi 1 Anda di sini. <b>Pedoman penting</b>: 347x288 piksel. <b>Format yang didukung</b>: .jpg, .jpeg, atau .png</p>
                        <label for="image-upload" class="custom-file-upload">
                            Unggah foto  <i class="fas fa-upload"></i>
                        </label>
                        <input id="image-upload" type="file" accept=".jpg, .jpeg, .png" onchange="previewImage()"/>
                    </div>
                </div>
                <div class="input">
                    <iframe id="html-preview"></iframe>
                    <div class="html">
                        <p>Unggah Simulasi pada materi yang akan anda unggah. </p>
                        <label for="html-upload" class="custom-file-upload">
                            Unggah Laman  <i class="fas fa-upload"></i>
                        </label>
                        <input id="html-upload" type="file" accept=".html" onchange="previewHTMLFile()">
                    </div>
                </div>
            </div>

        </div>
        <div class="form-group">
            <label for="judul">Judul</label>
            <div class="gabung-input-text">
                <input type="text" class="form-control" id="judul" maxlength="80" placeholder="Silahkan Tuliskan Judul Materi" oninput="updateCount()">
                <small id="judulHelp" class="form-text text-muted">0/80</small>
            </div>
        </div>
        <div class="form-group">
        <textarea id="summernote" name="editordata"></textarea>

        </div>
        <div class="form-group">
            <label for="detailEksperimen">Detail Eksperimen:</label>
            <textarea class="form-control" id="detailEksperimen"></textarea>
        </div>
        </form>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="JavaScript/script-header.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="JavaScript/materi.js"></script>
</body>
</html>
