@extends('admin.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать пользователя</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Главная</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <form action="{{route('users.update',$user->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group w-25">
                        <label for="name">Введите имя</label>
                        <input type="text" name="name" value="{{$user->name}}" id="name" placeholder="Введите имя">
                        <div class="text-danger">
                            @error('name')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group w-25">
                        <label for="email">Введите email</label>
                        <input type="email" name="email" id="email" value="{{$user->email}}" placeholder="Введите email">
                        <div class="text-danger">
                            @error('email')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group w-25">
                        <label for="number">Введите номер телефона</label>
                        <input type="number" name="phone" id="number" value="{{$user->phone}}" placeholder="Введите номер телефона">
                        <div class="text-danger">
                            @error('number')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group w-25">
                        <label for="role">Выберите роль</label>
                        <select name="role" id="role">
                            @foreach(\App\Models\User::getRoles() as $key=>$role):?>
                                <option value="{{$key}}" {{$key==$user->role ? 'selected':''}}>{{$role}}</option>
                            @endforeach
                        </select>
                        <div class="text-danger">
                            @error('role')
                            {{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="mt-2">
                        <input type="submit" class="btn btn-primary" value="Обновить">
                    </div>
                </form>

            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
