@extends('layouts.app', ['activePage' => 'time', 'titlePage' => __('Times')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <a href="/time-create"><button class="btn btn-primary">Cadastrar</button></a>

        </div>
        <div class="card">

          <div class="card-header card-header-primary">
            <h4 class="card-title ">Times</h4>
            {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div class="container-fluid">
                <table class="table table-striped">
                  <thead class=" text-primary">
                    <th>
                      Guild
                    </th>
                    <th>
                      Lider
                    </th>
                    <th>
                      Ações
                    </th>
                  </thead>
                  <tbody>
                    @foreach ($times as $time)
                      <tr>
                      <td> 
                      <img 
                        class="img-responsive img thumbnail" 
                        src="/storage/{{$time->logo}}" > 
                        <span class="font-weight-bold">{{$time->nome_time}}</span>
                      </td>
                      <td> 
                        <span class="font-weight-bold">{{$time->nome_representante}} </span>
                      </td>
                        <td>

                          <a href="{{ url('/time-edit', ['id' => $time->id]) }}">
                            <button class="btn btn-warning btn-sm">
                              <span class="material-icons">edit</span>
                            </button>
                          </a>

                          <a href="{{ url('/time-delete', ['id' => $time->id]) }}">
                            <button class="btn btn-danger btn-sm">
                              <span class="material-icons">delete</span>
                            </button>
                          </a>

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
    </div>
  </div>
</div>

<style>
  img{
  background-color: #ddd;
  border-radius: 100%;
  height: 4rem;
  object-fit: cover;
  width: 4rem;  
}
</style>


@endsection
