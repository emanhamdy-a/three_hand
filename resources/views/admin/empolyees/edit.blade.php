@extends('admin.index')
@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-5">
        <div class="col-sm-6">
          <h3 class="m-0 text-secondary">
            @if($title) {{$title}} @endif
          </h3>
        </div><!-- /.col -->
        @if(session()->has('success'))
        <div class="alert alert-success col-12">
          <h4>{{ session('success') }}</h4>
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger col-12">
          <h4>{{ session('error') }}</h4>
        </div>
        @endif
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary">
            <!-- form start -->
            <form method="post"
              action="{{ route('empolyees.update', $empolyee) }}"
              enctype="multipart/form-data" autocomplete="off" >
              @csrf
              @method('PUT')
              <div class="card-body">
                <div class="form-group">
                  <label for="createEmpolyeeFirstName">
                    First name
                  </label>
                  <input type="text" name="first_name"
                    class="form-control @error('first_name') is-invalid @enderror"
                    id="createEmpolyeeFirstName"
                    placeholder="Enter empolyee name" aria-invalid="false"
                    value="@if(old('first_name')){{ old('first_name') }}@else {{$empolyee->first_name}}@endif"/>
                    @error('first_name')
                      <span id="createEmpolyeeFirstName-error"
                        class="error invalid-feedback">
                       {{ $message }}
                      </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="createEmpolyeeLastName">
                    Last name
                  </label>
                  <input type="text" name="last_name"
                   class="form-control @error('last_name') is-invalid @enderror"
                   id="createEmpolyeeLastName"
                   placeholder="Enter empolyee last_name" aria-invalid="false"
                   value="@if(old('last_name')){{ old('last_name') }}@else {{$empolyee->last_name}}@endif"/>
                  @error('last_name')
                    <span id="createEmpolyeeLastName-error"
                    class="error invalid-feedback">
                   {{ $message }}
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="createEmpolyeePhone">
                    Phone
                  </label>
                  <input type="text" name="phone"
                   class="form-control @error('phone') is-invalid @enderror"
                   id="createEmpolyeePhone"
                   placeholder="Enter empolyee phone" aria-invalid="false"
                   value="@if(old('phone')){{ old('phone') }}@else {{$empolyee->phone}}@endif"/>
                    @error('phone')
                      <span id="createEmpolyeePhone-error"
                      class="error invalid-feedback">
                      {{ $message }}
                      </span>
                    @enderror
                </div>
                <div class="form-group">
                  <label for="createEmpolyeeEmail">Email</label>
                  <input type="email" name="email"
                   class="form-control @error('email') is-invalid @enderror"
                   id="createEmpolyeeEmail"
                   placeholder="Enter empolyee email" aria-invalid="false"
                   value="@if(old('email')){{ old('email') }}@else {{$empolyee->email}}@endif"/>
                  @error('email')
                    <span id="createEmpolyeeEmail-error"
                    class="error invalid-feedback">
                   {{ $message }}
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="createEmpolyeeStatus">Status</label>
                  <select name="status"
                    class="form-control @error('status') is-invalid @enderror"
                    id="createEmpolyeeStatus" aria-invalid="false">
                    <option value="0"
                      <?php
                        if(old('status') && old('status') ==='0'){
                          echo "selected";
                        }elseif($empolyee->status==='0' && old('status')!='1'){
                          echo "selected";
                        }else{} ?> >Disabled
                    </option>
                    <option value="1"
                      <?php
                      if(old('status') && old('status') =='1'){
                        echo "selected";
                      }elseif($empolyee->status=='1' && old('status') !=='0'){
                        echo "selected";
                      }else{} ?> >Enabled
                    </option>
                  </select>
                  @error('status')
                    <span id="createempolyeeStatus-error"
                    class="error invalid-feedback">
                    {{ $message }}
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="createEmpolyeeStatus">Company</label>
                  <select name="company_id"
                    class="form-control @error('company_id') is-invalid @enderror"
                    id="createEmpolyeeStatus" aria-invalid="false">
                    <option value="">Select empolyee company </option>
                    @foreach($companies as $company)
                    <option value="{{$company->id}}"
                      <?php
                      if(old('company_id')
                       && old('company_id') !=$empolyee->company_id){
                      echo "selected"; }elseif($empolyee->company_id==$company->id)
                      {echo 'selected';} ?> >
                     {{Str::limit($company->name,60)}}
                    </option>
                    @endforeach
                  </select>
                  @error('company_id')
                    <span id="createEmpolyeeStatus-error"
                    class="error invalid-feedback">
                   {{ $message }}
                    </span>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="createempolyeephoto">photo</label>
                  <input type="file" name="photo"
                  class="form-control @error('photo') is-invalid @enderror"
                  id="createempolyeephoto"
                  placeholder="Enter empolyee photo" aria-invalid="false"/>
                  @error('photo')
                    <span id="createempolyeephoto-error"
                    class="error invalid-feedback">
                    {{ $message }}
                    </span>
                  @enderror
                  <img
                    src="{{url('/')}}/storage/@if($empolyee->photo){{$empolyee->photo->filename}}
                    @endif" width='100'class='ml-3 mt-3' alt="">
                </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="/admin/empolyee" class="btn btn-secondary ml-4">
                  Cancel</a>
              </div>
            </form>
          </div>
          <!-- /.card -->
          </div>
      </div>
    <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
@endsection
