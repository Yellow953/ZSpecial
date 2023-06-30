@extends('admin.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 my-3">
            <div class="d-flex justify-content-between">
                <h4 class="header-title my-auto">Clients</h4>
                <a href="/client/new" class="btn btn-primary btn-rounded my-auto">Add</a>
            </div>
        </div>

        <!-- data table start -->
        <div class="col-12">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="data-tables">
                        <table id="dataTable" class="text-center w-100 border">
                            <thead class="bg-light text-capitalize">
                                <tr>
                                    <th>Client</th>
                                    <th>Contact</th>
                                    <th>Address</th>
                                    @if (Auth::user()->role == "admin")
                                    <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse( $clients as $client )
                                <tr>
                                    <td>
                                        {{ucfirst($client->name)}}
                                    </td>
                                    <td>
                                        {{$client->email }} <br>
                                        {{$client->phone}}
                                    </td>
                                    <td>
                                        {{$client->address}}
                                    </td>
                                    @if (Auth::user()->role == "admin")
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="/client/{{$client->id}}/edit"
                                                class="btn btn-warning btn-rounded m-1">Edit</a>
                                            <form method="GET" action="/client/{{$client->id}}/destroy">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-danger btn-rounded show_confirm m-1"
                                                    data-toggle="tooltip" title='Delete'>Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">No Clients yet ...</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- data table end -->
    </div>
</div>
@endsection