@extends('layouts.admin')
@section('content')
    <style>
        .flexi{
            display: flex;
            justify-content: center;
            gap: 0.2rem;
            margin-top: 0.3rem;
            color: white;
        }
        .darc{
            background-color: #152036;
        }
    </style>
    <h4>Таблица пользователей</h4>
    <table>
        <tr>
            <th>аватар</th>
            <th>id</th>
            <th>email</th>
            <th>имя</th>
            <th>Админ</th>
            <th>email верефицирован(дата)</th>
            <th>создан(дата)</th>
            <th>забанен</th>
            <th>причина бана</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td><img src="{{ asset('storage/' . $user->image) }}" alt="ватарка пользователя" /></td>
                <td>{{$user->id}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->admin}}</td>
                <td>{{$user->email_verified_at}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <button class="pd-setting">статус|когда</button>
                </td>
                <td>причина</td>
            </tr>
            <tr>
                <td colspan="9" class="p-0">
                    <!-- Кнопка с стрелкой для раскрытия/скрытия -->
                    <div class="text-center my-2">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="collapse" data-bs-target="#extraButtons{{$user->id}}" aria-expanded="false" aria-controls="extraButtons{{$user->id}}">
                            &#9660; Раскрыть опции
                        </button>
                    </div>
                    <!-- Контейнер с дополнительными кнопками -->
                    <div class="collapse" id="extraButtons{{$user->id}}">
                        <div class="flexi">
                            <div class="flexi">
                                <form action="{{route('bb.delete',$user->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input value="{{$user->id}}" class="form_del" type="hidden">
                                    <button class="btn darc" type="submit">Удалить</button>
                                </form>
                            </div>
                            <div class="flexi">
                                <form action="{{route('bb.delete',$user->id)}}" method="post">
                                    @csrf
                                    @method('patch')
                                    <input value="{{$user->id}}" class="form_del" type="hidden">
                                    <button class="btn darc">Забанить</button>
                                </form>
                            </div>
                            <div class="flexi">
                                <form action="{{route('bb.delete',$user->id)}}" method="post">
                                    @csrf
                                    @method('patch')
                                    <input value="{{$user->id}}" class="form_del" type="hidden">
                                    <button class="btn darc">Разбанить</button>
                                </form>
                            </div>
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
