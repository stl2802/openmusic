<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-..." crossorigin="anonymous">
</head>
<body>
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
                <form id="avatarForm" action="{{ route('profile.update.avatar') }}" method="POST" enctype="multipart/form-data" style="position: absolute; bottom: 0; right: 0;">
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
                <form id="profileForm" action="{{ route('profile.update') }}" method="POST" class="mt-2 d-none">
                    @csrf
                    @method('PATCH')

                    <div class="mb-2">
                        <label for="name" class="form-label mb-1">Имя</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" disabled>
                    </div>

                    <div class="mb-2">
                        <label for="email" class="form-label mb-1">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" disabled>
                    </div>

                    <div class="mb-2">
                        <label for="password" class="form-label mb-1">Пароль</label>
                        <input type="password" class="form-control" id="password" name="password" disabled>
                        <small class="text-muted">Введите новый пароль, чтобы изменить</small>
                    </div>

                    <div class="mt-3 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" id="cancelBtn">Отмена</button>
                        <button type="submit" class="btn btn-light">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
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
</html>
