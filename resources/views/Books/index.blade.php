@extends('layouts.app')
@section('content')

    @if($message = Session::get('success'))

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
                icon: "success",
                title: "{{$message}}"
            });
        </script>

    @endif



        <div class="search-form">
            <form action="{{route('books.index')}}" method="GET" accept-charset="UTF-8" role="search">

                <input type="text" id="search" name="search" placeholder="Enter book name" value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="add-button">
            <a href="{{route('books.create')}}" class="button">Add New Book</a>
        </div>
        <br style="clear: both"><br>


        <!-- Example data for testing, replace with your actual data -->


            @if(count($books) > 0)
            <table>
                <thead>
                <tr>
                    <th>Book Name</th>
                    <th>Cover</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Publication Year</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $row)
                    <tr>
                        <td>{{$row->book_name}}</td>
                        <td><img src="{{asset('images/'.$row->cover)}}" alt="Book Cover" width="50"></td>
                        <td>{{$row->author}}</td>
                        <td>{{$row->category}}</td>
                        <td>{{date('Y', strtotime($row->publication_year))}}</td>
                        <td>
                            <a href="{{route('books.edit', $row->id)}}" title="Edit"><i class="fas fa-edit"></i></a>
                            <form style="margin: 0px; padding: 0px; display: inline-block;" action="{{ route('books.destroy', $row->id) }}" method="post" id="deleteForm">
                                @method('delete')
                                @csrf
                                <a href="#" onclick="deleteConfirm(event)"><i class="fas fa-trash"></i></a>
                            </form>

                        </td>
                    </tr>

                @endforeach
            </tbody>
        </table>
            @else


                    <p>No Book Found</p>

            @endif

        {{$books->links('layouts.pagination')}}
        <br><br>
    </div>

    <script>
        window.deleteConfirm = function (e) {
            e.preventDefault();
            var form = document.getElementById('deleteForm');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    </script>


@endsection
