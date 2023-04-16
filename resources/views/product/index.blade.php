@extends('layouts.errors', ['view' => ['title']])

@section('title', 'Page Title')

@section('sidebar')
@parent

<p>This is appended to the master sidebar.</p>
@endsection

@section('content')
<ul>
  @foreach ($products as $product)

  <li>This is user {{ $product->price }}</li>
  <form method="POST" action=" {{ route('product.delete', ['id' => $product->id]) }}">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
    <button>Delete</button>
  </form>
  @endforeach
</ul>
@endsection