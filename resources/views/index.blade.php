@extends('layouts.app')
@section('title','Главная')
@section('content')
    <style>
        body{
            padding: 2rem;
        }
        .card-img-top{
            height: 10rem;
            object-fit:cover;
        }
        .card{
            border: 0.1rem solid blue;
        }
        .card-body{
            color: white;
        }
    </style>
    @if(count($bbs) > 0)
        @foreach($bbs as $bb)
            <div class="card" style="width: 18rem;">
                <img src="{{asset('storage/' . $bb->image) }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$bb->title}}</h5>
                    <p class="mb-1">Цена:{{$bb->price}}</p>
                    <p class="mb-0">Автор:{{$bb->user->name}}</p>
                    <a href="{{route('detail',$bb->id)}}" class="btn btn-primary">К музыке</a>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">Объявлений не найдено.</p>
    @endif
@endsection('content')
