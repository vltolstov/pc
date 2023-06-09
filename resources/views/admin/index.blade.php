@extends('.layouts.admin')

@section('admin-panel')

     <div class="container">
         <div class="row">
             <div class="col-lg-12">
                 <div class="admin-head">
                     <div class="row">
                         <div class="col-lg-10">
                             <a href="{{route('admin')}}" class="admin-title">Панель управления</a>
                         </div>
                         <div class="col-lg-2 admin-logout"><a href="{{route('logout')}}">Выход</a></div>
                     </div>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-lg-4">
                 @include('admin.sidebar')
             </div>
             <div class="col-lg-8">
                 @include('admin.create')
                 @include('admin.edit')
                 @include('admin.content')
             </div>
         </div>
     </div>

@endsection
