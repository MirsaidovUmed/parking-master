@extends('layouts.app')
@section('title-page')
    Статистика
@endsection
@section('content')
    <!-- Sale & Revenue Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3">
                        <h4 class="mb-2 fw-bold"><b>Дневная статистика</b></h4>
                        <span style="font-size: 14px">Среднее время парковок {{$avgMinCurrDay}}min</span>
                        <p class="mb-2">1234,00 сомони <span>{{$zaezdCountCurrDay}} заеда</span></p>
                    </div>
                    <div>
                        <span style="color: white">›</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3">
                        <h4 class="mb-2 fw-bold">Месячная статистика</h4>
                        <span style="font-size: 14px">Среднее время парковок {{$avgMinMonth}}min</span>
                        <p class="mb-2">12,302 сомони</p>
                        <span class="mb-2">{{$zaezdCountMonth}} заезда</span>
                    </div>
                    <div>
                        <span style="color: white">›</span>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">NERU <br><span>21 Пропуска</span></p>
                        <h6 class="mb-0">54 счетов</h6>
                    </div>
                    <div>
                        <span style="color: white">›</span>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4"></h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Гос.номер</th>
                                <th scope="col">Время въезда</th>
                                <th scope="col">Время выезда</th>
                                <th scope="col">Фото</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($eventTopVehiclesGet as $item)
                                <tr>
                                    <td>{{$item->plate_number}}</td>
                                    <td>{{$item->status_in_time}}</td>
                                    <td>{{$item->status_out_time}}</td>
                                    <td>
                                        <img src="{{$item->image_full_path_in}}" alt="">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sale & Revenue End -->
@endsection
