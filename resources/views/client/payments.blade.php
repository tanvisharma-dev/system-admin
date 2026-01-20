@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Payments</h3>
    @foreach($payments as $payment)
        <div>
            <p>Module: {{ $payment->module_name }}</p>
            <p>Status: {{ $payment->status }}</p>
            <p>Amount: ₹{{ $payment->amount }}</p>
        </div>
    @endforeach
</div>
@endsection
