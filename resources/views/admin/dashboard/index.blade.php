@extends('admin.layouts.app')
@section('content')
@section('pageTitle', 'Dashboard')


<div class="container">

<div class="row">
          <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box-content">
              <a  href="{{ route('admin.pos.index') }}" class="btn btn-secondary btn-lg" style="width: 100%;">POS</a>
            </div>
          </div>
          <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box-content">
              <a  href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-lg" style="width: 100%;">Orders</a>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-2 col-sm-2 col-md-2">
            <div class="info-box-content">
              <a  href="{{ route('admin.pop.index') }}" class="btn btn-secondary btn-lg" style="width: 100%;">POP</a>
            </div>
          </div>
          <div class="col-2 col-sm-2 col-md-3">
            <div class="info-box-content">
              <a  href="{{ url('admin/purchaseorders') }}" class="btn btn-secondary btn-lg" style="width: 100%;">Purchase Orders</a>
            </div>
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <!-- /.col -->

          <!-- /.col -->
        </div>
</div>

@endsection