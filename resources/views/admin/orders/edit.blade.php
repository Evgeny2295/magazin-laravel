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
                            <div class="table-responsive">
                                <table class="table text-start table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">Наименование</th>
                                        <th scope="col">Цена</th>
                                        <th scope="col">Кол-во</th>
                                        <th scope="col">Сумма</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orderProducts as $orderProduct)
                                    <tr>
                                        <td>{{$orderProduct->product->title}}</td>
                                        <td>{{$orderProduct->price}}</td>
                                        <td>{{$orderProduct->qty}}</td>
                                        <td>{{$orderProduct->sum}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="box">
                                <h3 class="box-title">Детали заказа</h3>
                                <div class="box-content">
                                    <div class="table-responsive">
                                        <table class="table text-start table-striped">
                                            <tr>
                                                <td>Номера заказа</td>
                                                <td>{{$order->id}}</td>
                                            </tr>
                                            <tr>
                                                <td>Статус</td>
                                                <td>{{$order->status ? 'Завершен' : 'Новый'}}</td>
                                            </tr>
                                            <tr>
                                                <td>Создан</td>
                                                <td>{{$order->created_at}}</td>
                                            </tr>
                                            <tr>
                                                <td>Обновлен</td>
                                                <td>{{$order->updated_at}}</td>
                                            </tr>
                                            <tr>
                                                <td>Итоговая сумма</td>
                                                <td>${{$order->total}}</td>
                                            </tr>
                                            <tr>
                                                <td>Примечание</td>
                                                <td>{{$order->note}}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <?php if (!$order->status): ?>
                                <form action="{{route('admin.orders.update',$order->id)}}" method=POST>
                                    @csrf
                                    @method('PATCH')
                                    <input type="text" name="status" value="1" hidden>
                                    <button type="submit" class="btn btn-success" >Изменить статус на завершен</button>
                                </form>
                            <?php else: ?>
                                <form action="{{route('admin.orders.update',$order->id)}}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="text" name="status" value="0" hidden>
                                    <button type="submit" value="1" class="btn btn-success">Изменить статус на Новый</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
