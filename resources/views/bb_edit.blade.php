@extends ('layouts.app')
@section('title', 'Изменение объявления :: Мои объявления')
@section ('content')
    <form action="{{ route('bb.update',$bb->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="txtTitle" class="form-label">Toвap</label>
            <input name="title" id="txtTitle" class="form-control @error('title') is-invalid @enderror " value="{{old('title',$bb->title)}}">
            @error('title')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="txtContent" class="form-label">
                Описание
            </label>
            <input name="content" id="txtContent" class="form-control @error('content') is-invalid @enderror " row="3" value="{{old('content',$bb->content)}}">
            @error('content')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div>
            <label for="txtImage" class="form-label">Изображение</label>
            <input name="image" type="file" id="txtImage" class="form-control @error('image') is-invalid @enderror">
            @error('image')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div>
            <label for="txtImage" class="form-label">Музыка</label>
            <input name="music" type="file" id="txtMusic" class="form-control @error('music') is-invalid @enderror">
            @error('music')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="txtPrice" class="form-label @error('content') is-invalid @enderror">Leна</label>
            <input name="price" id="txtPrice" class="form-control" value="{{old('price',$bb->price)}}">
            @error('price')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <input type="submit" class="btn btn-primary" value="Изменить">
    </form>
@endsection ('content')
