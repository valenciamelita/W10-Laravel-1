@extends("template.main")
@section('title', 'Contact Us')
@section('body')
    <div class="container">
        <h2>Contact Us Data</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Message</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $index => $contact)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $contact['name'] }}</td>
                        <td>{{ $contact['email'] }}</td>
                        <td>{{ $contact['phone'] }}</td>
                        <td>{{ $contact['message'] }}</td>
                        <td>
                            <!-- Formulir untuk menghapus kontak -->
                            <form action="{{ route('contact.destroy', $index) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
