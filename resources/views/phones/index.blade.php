@section('title', 'All phones')
@extends('layouts.master')

@section('main')
    <h1 class="display-4 m-3">All phones</h1>

    <div class="col-10 offset-1">
        <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Brand</th>
                        <th>Price</th>
                        <th>Delete</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($all_phones as $phone)
                    <tr>
                        <td>{{ $phone->name }}</td>
                        <td>{{ $phone->brand }}</td>
                        <td>{{ $phone->price }}</td>
                        {{-- <td><a href="phones/{{ $phone->id }}" class="btn btn-danger btn-sm">Delete</a></td> --}}
                        <td>
                            <form action="phones/{{ $phone->id }}" method="POST">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>

                        </td>

                        <td>
                            <a href="/phones/{{$phone->id}}/edit" class="btn btn-warning btn-sm">Update</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        </table>
    </div>
@endsection