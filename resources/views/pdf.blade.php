<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View PDF or Image</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .frame-container {
            width: 100%;
            height: 800px;
            border: 1px solid #ccc;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .frame-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        @if (pathinfo($pdfPath, PATHINFO_EXTENSION) == 'pdf')
            <a href="{{ url('view/' . $data->id) }}" target="_blank">
                <iframe src="{{ asset('storage/' . $data->file_path) }}" width="100%" height="800px"></iframe>
            </a>
        @else
            <a href="{{ url('view/' . $data->id) }}">
                <div class="frame-container">
                    <img class="img-fluid" src="{{ asset('storage/' . $data->file_path) }}" alt="{{ $data->title }}">
                </div>
            </a>
        @endif
        <a href="{{ url('/') }}" class="btn btn-primary mt-3" target="_blank">Back</a>
    </div>
</body>

</html>
