@extends('layouts.app', ['activePage' => 'partida', 'titlePage' => __('Cadastrar Partida')])


@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <a href="/partida"><button class="btn btn-secondary">Voltar</button></a>
        </div>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Cadastrar Partida</h4>
            <p class="card-category"></p>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <br>
              <form action="partida-create" method="POST">
               
                {{csrf_field()}}
                <div class="form-group">
                  <label for="num_rodada">Numero de Rodadas</label>
                  <input type="text" class="form-control" id="num_rodada" name="num_rodada"  required>
                </div>

                <div class="form-group">
                  <label for="id_temporada">Temporada</label>
                  <input type="text" class="form-control" id="id_temporada" name="id_temporada" required>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
      
              </form>

              
            </div>
          </div>
        </div>
      </div>
      
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection