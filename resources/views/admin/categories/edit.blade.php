@extends('admin.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать категорию</h1>
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
                <form action="{{route('categories.update',$category->id)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group w-25">
                        <label for="title">Введите наименование категории</label>
                        <input type="text" name="title" value="{{$category->title}}" placeholder="Введите наименование">
                        <div class="text-danger">
                            @error('title')
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
