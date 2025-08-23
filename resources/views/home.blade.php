@extends ('layouts.app')
@section ('title', 'Мои объявления')
@section ('content')
    <style>
        .bg-darkblue {
            background-color: #001f3f; /* тёмно-синий */
        }
        .text-light {
            color: #fff; /* светлый текст для читаемости */
        }
    </style>
    <div class="container my-4">
        <div class="container my-4 bg-darkblue text-light p-3 rounded">
            <div class="card p-3 bg-darkblue text-light">
                <div class="d-flex align-items-center">
                    <!-- Аватарка -->
                    <div class="position-relative me-3" style="width: 100px; height: 100px;">
                        <div class="avatar-wrapper rounded-circle overflow-hidden" style="width: 100%; height: 100%; background: linear-gradient(to top, #001f3f 30%, transparent 30%);">
                            @if($user->image)
                                <img src="{{ asset('storage/' . $user->image) }}" alt="Avatar" class="w-100 h-100 object-fit-cover rounded-circle">
                            @else
                                <div class="d-flex justify-content-center align-items-center w-100 h-100 bg-secondary text-white fs-4" style="height: 100%; width: 100%;">
                                    <i class="bi bi-person-fill"></i> <!-- иконка Bootstrap Icons -->
                                </div>
                            @endif
                        </div>
                        <!-- Кнопка для загрузки новой аватарки -->
                        <form id="avatarForm" action="{{ route('profile.update.avatar',Auth::user()) }}" method="POST" enctype="multipart/form-data" style="position: absolute; bottom: 0; right: 0;">
                            @csrf
                            @method('PATCH')
                            <label class="btn btn-sm btn-primary mb-0" style="border-radius: 50%; padding: 5px; position: relative; cursor: pointer;">
                                <i class="bi bi-camera"></i>
                                <input type="file" name="image" style="display: none;" onchange="document.getElementById('avatarForm').submit();">
                            </label>
                        </form>
                    </div>

                    <!-- Информация -->
                    <div style="flex: 1;">
                        <div class="d-flex align-items-center justify-content-between">
                            <h5 class="mb-0" id="nameDisplay">{{ $user->name }}</h5>
                            <button class="btn btn-sm btn-outline-light" id="editBtn">Изменить</button>
                        </div>
                        <form id="profileForm" action="{{ route('profile.update', Auth::user()) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="mb-2">
                                <label for="name" class="form-label mb-1">Имя</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror " id="name" name="name" value="{{ $user->name }}" disabled>
                            </div>
                            @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror

                            <div class="mb-2">
                                <label for="email" class="form-label mb-1">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror " id="email" name="email" value="{{ $user->email }}" disabled>
                            </div>
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror

                            <div class="mb-2">
                                <label for="password" class="form-label mb-1">Пароль</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror " id="password" name="password" disabled>
                                <small class="text-muted">Введите новый пароль, чтобы изменить</small>
                            </div>
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror

                            <div class="mt-3 d-flex justify-content-end">
                                <button type="button" class="btn btn-secondary me-2" id="cancelBtn">Отмена</button>
                                <button type="submit" class="btn btn-light">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('bb.create') }}" class="btn btn-primary">Добавить объявление</a>
        </div>
        @if (count($bbs) > 0)
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                <tr>
                    <th>Товар</th>
                    <th>Цена, руб.</th>
                    <th colspan="2" class="text-center">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($bbs as $bb)
                        <tr>
                            <td>
                                <a href="{{route('detail',$bb->id)}}">
                                    <h5 class="mb-0">{{ $bb->title }}</h5>
                                </a>
                            </td>
                            <td>{{ $bb->price }}</td>
                            <td class="text-center">
                                <a href="{{ route('bb.edit', $bb->id) }}" class="btn btn-sm btn-warning">Изменить</a>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('bb.delete', $bb->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Вы уверены, что хотите удалить?')">Удалить</button>
                                </form>
                            </td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center">Объявлений не найдено.</p>
        @endif
    </div>
    <!-- Скрипты -->
    <script>
        document.getElementById('editBtn').addEventListener('click', () => {
            document.getElementById('profileForm').classList.remove('d-none');
            document.getElementById('name').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('password').disabled = false;
            document.getElementById('editBtn').style.display = 'none';
        });

        document.getElementById('cancelBtn').addEventListener('click', () => {
            document.getElementById('profileForm').classList.add('d-none');
            document.getElementById('name').disabled = true;
            document.getElementById('email').disabled = true;
            document.getElementById('password').disabled = true;
            document.getElementById('editBtn').style.display = 'inline-block';

            // Возврат значений
            document.getElementById('name').value = '{{ $user->name }}';
            document.getElementById('email').value = '{{ $user->email }}';
            document.getElementById('password').value = '';
        });
    </script>
@endsection
