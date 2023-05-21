
@if (Session::has('status'))
    <div class="alert alert-success" role="alert">
        {{ Session::get('message') }}
    </div>
@endif

<table class="table table-bordered" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Handphone</th>
            <th>Join Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->handphone }}</td>
                <td>{{ $item->joinDate }}</td>
                <td>
                    <a href="/employee-edit/{{ $item->id }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="" class="btn btn-danger">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


<div class="my-3">
    {{ $data->withQueryString()->links() }}
</div>
