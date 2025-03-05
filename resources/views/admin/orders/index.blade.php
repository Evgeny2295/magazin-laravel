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
                    <!-- Default box -->
                    <div class="card">

                        <div class="card-body">
                            <?php if (!empty($orders)): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID заказа</th>
                                        <th>Статус</th>
                                        <th>Создан</th>
                                        <th>Изменен</th>
                                        <th>Сумма</th>
                                        <td style="width: 50px"><i class="fas fa-pencil-alt"></i></td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orders as $order): ?>
                                    <tr <?php if ($order['status']) echo 'class="table-info"' ?>>
                                        <td><?= $order['id'] ?></td>
                                        <td>
                                                <?= $order['status'] ? 'Завершен' : 'Новый' ?>
                                        </td>
                                        <td><?= $order['created_at'] ?></td>
                                        <td><?= $order['updated_at'] ?></td>
                                        <td>$<?= $order['total'] ?></td>
                                        <td style="width: 50px">
                                            <a class="btn btn-info btn-sm" href="{{route('admin.orders.edit',$order->id)}}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                {{$orders->links()}}
                            </div>

                            <?php else: ?>
                            <p>Заказов не найдено...</p>
                            <?php endif; ?>

                        </div>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
