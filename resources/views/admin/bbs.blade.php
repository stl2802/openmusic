@extends('layouts.admin')
@section('content')
    <style>
        .form_del{
            display: none;
        }
    </style>
    <h4>Таблица пользователей</h4>
    <table>
        <tr>
            <th>id</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Превью</th>
            <th>Музыка</th>
            <th>Цена</th>
            <th>user_id</th>
            <th>status</th>
            <th>is_published</th>
            <th>created_at</th>
            <th>updated_at</th>
            <th>deleted_at</th>
        </tr>
        @foreach($bbs as $bb)
            <tr>
                <td><img src="#" alt="ватарка пользователя" /></td>
                <td>{{$bb->id}}</td>
                <td>{{$bb->title}}</td>
                <td>{{$bb->content}}</td>
                <td><img src="{{$bb->image}}" alt="картинка трека"></td>
                <td><audio src="{{$bb->music }}"></audio></td>
                <td>{{$bb->user_id}}</td>
                <td>{{$bb->status}}</td>
                <td>{{$bb->	is_published}}</td>
                <td>{{$bb->	created_at}}</td>
                <td>{{$bb->	updated_at}}</td>
                <td>{{$bb->	deleted_at}}</td>
            </tr>
            <tr>
                <td colspan="9" class="p-0">
                    <div class="text-center my-2">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#extraButtons{{$bb->id}}" aria-expanded="false" aria-controls="extraButtons{{$bb->id}}">
                            &#9660; Раскрыть опции
                        </button>
                    </div>
                    <div class="collapse" id="extraButtons{{$bb->id}}">
                        <div class="flexi">
                            <form action="{{route('bb.delete',$bb->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <input value="{{$bb->id}}" class="form_del" type="hidden">
                                <button class="btn darc" type="submit">Удалить</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
    <div class="custom-pagination">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </div>
@endsection
