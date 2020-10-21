@extends('layouts.index')

@section('content')
    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">

                <product-component :products="" />
            </div>
        </div>
    </div>
@endsection
