@extends('admin.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактировать продукт</h1>
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
                <form action="{{route('products.update',$product->slug)}}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-2">
                        <input type="text" name="title" value="{{$product->title}}" placeholder="Введите наименование">
                    </div>
                    <div>
                        @error('title')
                        {{$message}}
                        @enderror
                    </div>
                    <div class="mb-2">
                        <textarea name="description" cols="30" rows="10" placeholder="Описание">{{$product->description}}</textarea>
                    </div>
                    <div>
                        @error('description')
                        {{$message}}
                        @enderror
                    </div>
                    <div class="mb-2">
                        <input type="number" name="price" value="{{$product->price}}" placeholder="Цена">
                    </div>
                    <div>
                        @error('price')
                        {{$message}}
                        @enderror
                    </div>
                    <div class="mb-2">
                        <input type="number" name="count" value="{{$product->count}}" placeholder="Количество">
                    </div>
                    <div>
                        @error('count')
                        {{$message}}
                        @enderror
                    </div>
                    <div class="form-group mb-2">
                        <label>Выберите категорию</label>
                        <select name="category_id" class="form-control select2" style="width: 100%;">
                            <option disabled selected>Выберите</option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" {{$product->category_id == $category->id ? 'selected' : ''}}>{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        @error('category_id')
                        {{$message}}
                        @enderror
                    </div>
                                 <div>
                        @error('colors')
                        {{$message}}
                        @enderror
                    </div>
                    <div class="mb-2 w-25 input-group">
                        <div class="custom-file">
                            <input type="file" name="preview_image" class="custom-file-input" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Загрузить</span>
                        </div>
                    </div>
                    <div>
                        @error('preview_image')
                        {{$message}}
                        @enderror
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
