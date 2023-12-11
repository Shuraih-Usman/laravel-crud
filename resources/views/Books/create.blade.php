@extends('layouts.app')
@section('content')
<body>
<style>
    select option {
        font-size:20px;
        padding:4px;
        margin: 10px;
    }
</style>
  <div class="container">
        <div class="error-container">
                @if($errors->any())
                    <script type="text/javascript">
                        const Toast = Swal.mixin({
                          toast: true,
                          position: "top-end",
                          showConfirmButton: false,
                          timer: 3000,
                          timerProgressBar: true,
                          didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                          }
                        });
                        Toast.fire({
                          icon: "warning",
                          title: "{{ $errors->first() }}"
                        });
                    </script>
                @endif
            </div>
        <div class="form-container" style="float: left; width: 45%;">


            <form method="post" action=" {{route('books.store')}} " enctype="multipart/form-data">
                @csrf
                <h2>Add  Book</h2>

                <!-- Books Name -->
                <label for="bookName">Book Name:</label>
                <input type="text" id="bookName" name="bookName">

                <!-- Cover -->
                <label for="cover">Cover :</label>
                <input type="file" id="cover" name="cover" onchange="showFile(event)">
                <img src="" width="200" id="preview">

                <!-- Author -->
                <label for="author">Author:</label>
                <input type="text" id="author" name="author">



        </div>

         <div class="form-container" style="float: left; width: 45%;">
            <!-- Category -->
            <label for="category">Category:</label>
            <select name="category">
                <option value="Littatafan Yaki">Littatafan Yaki</option>
                <option value="Littatafan Soyayya">Littatafan Soyayya</option>
                <option value="Littatafan Almara">Littatafan Almara</option>
                <option value="Littatafan bata kashi">Littatafan bata kashi</option>
                <option value="Littatafan ban tsoro">Littatafan ban tsoro</option>
                <option value="Hikayoyi">Hikayoyi</option>
                <option value="Adabi">Adabi</option>
                <option value="Tarihi">Tarihi</option>


            </select>

            <!-- Publication Year -->
            <label for="publicationYear">Publication Year:</label>
            <input type="date" id="publicationYear" name="publicationYear">
             <!-- Submit Button -->
                <button type="submit">Add Book</button>
            </form>
        </div>
    </div>





<script>
    function showFile(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function () {
            var dataURL = reader.result;
            var output = document.getElementById('preview');
            output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    }
</script>

</body>
</html>
@endsection
