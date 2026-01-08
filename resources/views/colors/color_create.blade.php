@extends('layouts.base')
@section('content')
    <h3 class="container">Установление цвета</h3>
   <form class="container" action="/colors" method="POST">
       @csrf
       @if(isset($payment))
       <div class="mb-3">
           <label for="name" class="form-label">Наименование цвета</label>
           <input  class="form-control" id="name" name="name" value="{{ old('name') }}">
           <div  class="form-text">Выбираем название цвета по таблице RAL</div>
           @if ($errors->get('name'))
               <div class="alert alert-danger">
                   <ul>
                       @foreach ($errors->get('name') as $error)
                           <li>{{ $error }}</li>
                       @endforeach
                   </ul>
               </div>
           @endif
       </div>

           @if($payment === 'notFree')
               <div class="mb-3">
                   <label for="price" class="form-label">Стоимость цвета</label>
                   <input  class="form-control" id="price" name="price" placeholder="100,00">
                   <div  class="form-text">Определяем стоимость цвета в рублях</div>
                   @if ($errors->get('price'))
                       <div class="alert alert-danger">
                           <ul>
                               @foreach ($errors->get('price') as $error)
                                   <li>{{ $error }}</li>
                               @endforeach
                           </ul>
                       </div>
                   @endif
               </div>

               <input hidden name="payment" value="notFree">
           @endif
           @if($payment === "free")
               <input hidden name="payment" value="free">
               <input hidden name="price" value="0.00">
           @endif
       @endif
       @if(!isset($payment))
       <select class="form-select"  name="payment">
           <option value="free">Бесплатно</option>
           <option value="notFree">Платно</option>
       </select>
           <input hidden name="service" value="true">
       <div class="form-text">Определяем врозможность дополнитиетльной оплаты за выбор цвета</div>
       @endif
       <button type="submit" class="btn btn-primary">Отправить</button>
   </form>
@endsection
