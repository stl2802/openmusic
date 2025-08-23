@extends('layouts.app')
@section('title','товар')
@section('content')
            <style>
                .bg-light{
                    background-color: black;
                }
                .product-container{
                    color: white;
                }
                .music_index{
                    padding-top: 25rem;
                    background-image: url({{asset('storage/' . $bb->image)}});
                    position: relative;
                }
                .background-image__wrapper{

                }
                .background-image {
                    border: 0.2rem solid blue;
                    width: 25rem;
                    height: 25rem;
                    object-fit: cover;
                    position: absolute;
                    z-index: 3;
                    left: 37%;
                    top: 11%;
                }

                .content {
                    border-top: 0.2rem solid blue;
                    height: 100%;
                    z-index: 2; /* слой перед изображением */
                    padding: 20px; /* отступы для текста и элементов */
                    padding-top: 12rem;
                    /* дополнительные стили, например, цвет текста */
                    background-color: rgb(0, 0, 0); /* полупрозрачный фон, чтобы текст был читаем */
                }
                .title_show{
                    text-align: center;
                }
                .flex_music_audio{
                    display: flex;
                    justify-content: center;
                }
                .music_audio{
                    width: 70%;
                }
                .music_audio_wrapper{
                    margin-bottom: -2rem;
                }
                ul{
                    display: flex;
                    justify-content: space-between;
                }
                .card{
                    background-color: black;
                }
            </style>
            <div class="product-container">
                <div class="background-image__wrapper">
                    <img src="{{ asset('storage/' . $bb->image) }}" alt="аватарка" class="background-image">
                </div>
                <div class="content">
                    <h3 class="title_show">Название: {{ $bb->title }}</h3>
                    <p class="card-text">Цена: {{ $bb->price }} руб.</p>
                    <p class="card-text">Созданно {{$bb->user->name}}</p>
                    <p class="card-text">Статус @if($bb->status) подтвержденно @endif не подтверджено</p>
                    <div class="music_audio_wrapper">
                        <div class="flex_music_audio">
                            <audio controls class="music_audio">
                                <source src="{{ asset('storage/' . $bb->music) }}" type="audio/mpeg">
                                Ваш браузер не поддерживает воспроизведение аудио.
                            </audio>
                        </div>
                        <ul>
                            <p class="card-text">Лайки {{$bb->likes}}</p>
                            <p class="card-text">Дизлайки {{$bb->dislikes}}</p>
                            <p class="card-text">Просмотры {{$bb->views}}</p>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card">
                <h3>Комментарии</h3>
                @auth
                    <form method="post" action="{{ route('com.store', $bb->id) }}">
                        @csrf
                        <label>
                            <input name="content" type="text">
                        </label>
                        <button>Добавить коментарий</button>
                    </form>
                @endauth
                <ul>
                    @foreach($bb->comments as $comment)
                        <li class="card-body">
                            {{$comment->content}}
                            {{$comment->user->name}}
                            {{$comment->like}}
                            {{$comment->dislike}}
                            <a href="{{route('com.edit',$bb->id)}}">Изменить</a>
                            <a>Удалить</a>
                        </li>
                    @endforeach
                </ul>
            </div>
@endsection('content')
