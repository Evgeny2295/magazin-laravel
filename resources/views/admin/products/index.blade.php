@extends('admin.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Продукты</h1>
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
            <div class="row">
                <div class="col-12 w-75">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{route('products.create')}}"><input class="btn btn-primary" type="submit" value="Добавить"></a>
                        </div>
                        <div class="card-body">
                                <?php if (!empty($products)): ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Фото</th>
                                            <th>Наименование</th>
                                            <th>Цена</th>
                                            <th>Статус</th>
                                            <td style="width:50px"><i class="fas fa-pencil-alt"></i></td>
                                            <td style="width:50px"><i class="far fa-trash-alt"></i></td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($products as $product): ?>
                                        <tr>
                                            <td><?= $product['id'] ?></td>
                                            <td>
                                                <img src="{{url('storage/'.$product['img'])}}" alt="" height="40">
                                            </td>
                                            <td>
                                                <a href="{{route('products.show',$product['slug'])}}">{{$product['title']}}</a>
                                            </td>
                                            <td>
                                                $<?= $product['price'] ?>
                                            </td>
                                            <td>
                                                {{$product['status'] ? 'Активен' : 'Не активен' }}
                                            </td>
                                            <td>
                                                <a
                                                   class="btn btn-info btn-sm"
                                                   href="{{route('products.edit',$product['slug'])}}">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a
                                                    class="btn btn-danger btn-sm delete"
                                                    href="{{route('products.destroy',$product['slug'])}}">
                                                    <i class="far fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    {{$products->links()}}
                                </div>

                                <?php else: ?>
                                <p>Товаров не найдено...</p>
                                <?php endif; ?>

                            </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
