<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <title>File Upload Form</title>
    <style>
        /* Adjust select2 styling */
        .select2-container .select2-selection--single {
            height: 40px;
            padding: 5px;
        }

        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
        @import url("https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap");

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .file-upload-container {
            padding: 30px 0;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fcfcfc;
            flex-direction: column;
        }

        .file-upload-card {
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            width: 800px;
            background-color: #ffffff;
            padding: 10px 30px 40px;
        }

        .file-upload-card h3 {
            font-size: 22px;
            font-weight: 600;
        }

        .file-dropbox {
            margin: 10px 0;
            padding: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            border: 3px dotted #a3a3a3;
            border-radius: 5px;
        }

        .file-dropbox h4 {
            font-size: 16px;
            font-weight: 400;
            color: #2e2e2e;
        }

        .upload-btn {
            background-color: #005af0;
            color: #ffffff;
            border: none;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .college-dropdown {
            list-style: none;
            margin: 0;
            margin-top: 80px;
            padding: 0;
            max-height: 200px;
            max-width: 350px;
            overflow-y: auto;
            border: 1px solid #ccc;
            background-color: #fff;
            position: absolute;
            z-index: 100;
            display: flex;
            flex-direction: column;
        }

        .college-dropdown li {
            padding: 10px;
            cursor: pointer;
        }

        .college-dropdown li:hover {
            background-color: #f1f1f1;
        }

        .upload-btn:hover {
            background-color: #ffffff;
            color: #005af0;
            outline: 1px solid #010101;
        }

        .form-input-section {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 20px;
        }

        .form-input-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .form-input-group input,
        textarea,
        select {
            width: 100%;
            height: 40px;
            padding: 0 10px;
            border: 0.5px solid #a3a3a3;
            border-radius: 5px;
        }

        textarea {
            height: auto;
        }

        .loading-bar {
            margin-top: 20px;
        }

        .upload-file-group,
        .tag-input-group {
            grid-column: 1 / span 2;
        }

        @media screen and (max-width: 768px) {
            .college-dropdown {
                max-width: 300px;
            }

            .file-upload-container {
                padding: 10px;
            }

            .file-upload-card {
                width: 100%;
            }

            .form-input-section {
                display: flex;
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <div class="file-upload-container">
        <form action="{{ url('update/uploadfiles/' . $data->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="file-upload-card">
                <h3>Upload Files</h3>
                <div class="file-dropbox">
                    <header>
                        <h4>Select File here</h4>
                    </header>
                    <input type="file" accept="" id="fileInputID" name="files" style="display: none;" />
                    <label for="fileInputID" class="upload-btn">Choose File</label>
                </div>

                <div class="form-input-section">
                    <div class="form-input-group">
                        <label for="fileTitleInput">File Title</label>
                        <input type="text" id="fileTitleInput" placeholder="File Title" name="title" value="{{ old('title', $data->title) }}" required />
                    </div>

                    <div class="form-input-group">
                        <label for="fileDescriptionInput">File Description</label>
                        <textarea id="fileDescriptionInput" placeholder="File Description" name="description" required>{{ old('description', $data->description) }}</textarea>
                    </div>

                    <div class="form-input-group">
                        <label for="collegeSearchInput">Select College/University</label>
                        <select name="college" id="collegeDropdown" style="width: 100%;">
                            <option value="">Select College</option>
                            @foreach($colleges as $college)
                                <option value="{{ $college->id }}" {{ old('college', $data->college) == $college->college ? 'selected' : '' }}>{{ $college->colleges->College_Name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-input-group">
                        <label for="courseSelect">Select Course</label>
                        <select id="courseSelect" name="course" required>
                            <option value="">Select Course</option>
                            @foreach ($course as $courses)
                                <option value="{{ $courses->id }}" {{ old('course', $data->course) == $courses->id ? 'selected' : '' }}>{{ $courses->course_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-input-group">
                        <label for="subjectSelect">Select Subject</label>
                        <select id="subjectSelect" name="subject" required>
                            <option value="">Select Subject</option>
                            @foreach ($subject as $subjects)
                            <option value="{{ $subjects->id }}" {{ old('subject', $data->subject) == $subjects->id ? 'selected' : '' }}>{{ $subjects->subject_name }}</option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-input-group">
                        <label for="yearSelect">Select Year</label>
                        <select id="yearSelect" name="year" required>
                            <option value="">Select Year</option>
                            <option value="1st Year" {{ old('year', $data->year) == '1st Year' ? 'selected' : '' }}>1st Year</option>
                            <option value="2nd Year" {{ old('year', $data->year) == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                            <option value="3rd Year" {{ old('year', $data->year) == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                            <option value="4th Year" {{ old('year', $data->year) == '4th Year' ? 'selected' : '' }}>4th Year</option>
                        </select>
                    </div>

                    <div class="form-input-group">
                        <label for="semesterSelect">Select Semester</label>
                        <select id="semesterSelect" name="semester" required>
                            <option value="">Select Semester</option>
                            <option value="1st Semester" {{ old('semester', $data->semester) == '1st Semester' ? 'selected' : '' }}>1st Semester</option>
                            <option value="2nd Semester" {{ old('semester', $data->semester) == '2nd Semester' ? 'selected' : '' }}>2nd Semester</option>
                            <option value="3rd Semester" {{ old('semester', $data->semester) == '3rd Semester' ? 'selected' : '' }}>3rd Semester</option>
                            <option value="4th Semester" {{ old('semester', $data->semester) == '4th Semester' ? 'selected' : '' }}>4th Semester</option>
                            <option value="5th Semester" {{ old('semester', $data->semester) == '5th Semester' ? 'selected' : '' }}>5th Semester</option>
                            <option value="6th Semester" {{ old('semester', $data->semester) == '6th Semester' ? 'selected' : '' }}>6th Semester</option>
                            <option value="7th Semester" {{ old('semester', $data->semester) == '7th Semester' ? 'selected' : '' }}>7th Semester</option>
                            <option value="8th Semester" {{ old('semester', $data->semester) == '8th Semester' ? 'selected' : '' }}>8th Semester</option>
                        
                        </select>
                    </div>

                    <div class="form-input-group">
                        <label for="categorySelect">Select Category</label>
                        <select id="categorySelect" name="category" required>
                            <option value="">Select Category</option>
                            <option value="Old Paper" {{ old('category', $data->category) == 'Old Paper' ? 'selected' : '' }}>Old Paper</option>
                            <option value="Pdf" {{ old('category', $data->category) == 'Pdf' ? 'selected' : '' }}>Pdf</option>
                            <option value="Notes" {{ old('category', $data->category) == 'Notes' ? 'selected' : '' }}>Notes</option>
                        </select>
                    </div>

                    <div class="tag-input-group">
                        <button type="submit" class="upload-btn">Upload File</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#collegeDropdown').select2({
                placeholder: 'Select College',
                allowClear: true,
                ajax: {
                    url: '/search-colleges',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            query: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.map(function(college) {
                                return {
                                    id: college.id,
                                    text: college.College_Name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            $('#courseSelect').on('change', function() {
                var courseId = $(this).val();

                if (!courseId) {
                    $('#subjectSelect').html('<option value="">Select Subject</option>');
                    return;
                }
                $.ajax({
                    url: '/get-subjects/' + courseId,
                    type: 'GET',
                    success: function(data) {
                        $('#subjectSelect').html('<option value="">Select Subject</option>');
                        $.each(data.subjects, function(key, subject) {
                            $('#subjectSelect').append('<option value="' + subject.id + '">' +
                                subject.subject_name + '</option>');
                        });
                    },
                    error: function() {
                        alert('Error fetching subjects. Please try again.');
                    }
                });
            });
        });
    </script>
</body>

</html>
