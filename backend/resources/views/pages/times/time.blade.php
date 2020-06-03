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
                <table class="table table-hover table-sm">
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
                      <td> <img src="<?= $time->logo; ?>"  height="42" width="42"> 
                        {{" - ". $time->logo}} 
                      </td>
                        <td> {{$time->nome_representante}} </td>
                        <td>

                          <a href="{{ url('/time-edit', ['id' => $time->id]) }}">
                            <button class="btn btn-warning btn-sm">
                              <span class="material-icons">edit</span>
                            </button>
                          </a>

                          <a href="{{ url('/time-delete', ['id' => $time->id]) }}">
                            <button class="btn btn-danger btn-sm">
                            {{-- <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"> --}}
                              <span class="material-icons">delete</span>
                            </button>
                          </a>

                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
                
                {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Atenção</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <h6>Tem certeza que deseja apagar o time {{$time->nome_time}}</h6>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <a href="{{ url('/time-delete', ['id' => $time->id]) }}">
                          <button type="button" class="btn btn-danger">Confirma</button>
                        </a>
                      </div>
                    </div>
                  </div>
                </div> --}}

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection
