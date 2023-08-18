@extends('layouts.mainlayout')

@section('title', 'View Table')

@section('content')


    <h1 class="h3 mb-2 text-gray-800">View Table</h1>
    <h4 class="font-weight-bold">Please Choose Your Tables For Booking</h4>

    <div class="container">
        <div class="row text-center">
            @foreach ($data as $item)
                <div class="col-lg-4 mb-2 mt-2">
                    <img class="rounded-circle" src="{{ asset('images/table.png') }}" alt="Table" width="140"
                        height="140">
                    <h3 class="h4 text-gray-800 mt-2">Table {{ $item->name }}</h3>
                    @if ($item->description == 'Empty')
                        <p><a class="btn btn-primary" href="/order/{{ $item->id }}" role="button">Booking</a></p>
                    @else
                        <p>
                            <a class="btn btn-secondary disabled" href="/order/{{ $item->id }}"
                                role="button">Booked</a>
                            <a class="btn btn-info" href="/order/{{ $item->id }}" role="button">View Order</a>
                        </p>
                    @endif
                </div><!-- /.col-lg-4 -->
            @endforeach
        </div>
    </div>


@endsection
