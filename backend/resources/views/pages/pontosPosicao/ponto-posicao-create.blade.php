@extends('layouts.app', ['activePage' => 'pontoPosicao', 'titlePage' => __('Cadastrar Pontos por Posição')])


@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <a href="/ponto-posicao"><button class="btn btn-secondary">Voltar</button></a>
        </div>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Cadastrar Pontos por Posição</h4>
            <p class="card-category"></p>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <br>
              <form action="ponto-posicao-create" method="POST">
               
                {{csrf_field()}}

                <div class="form-group">
                  <label for="id_temporara">Temporada</label> 
                  <select name="id_temporara" class="custom-select" required>
                    <option disabled selected>Selecione um Time</option>

                    @foreach ($temporadas as $temporada)
                      <option value="{{$temporada->id}}">{{$temporada->nome_temporada}}</option>
                    @endforeach

                  </select>
                </div>

                <div class="form-group">
                  <label for="posicao">Posição</label>
                  <input type="text" class="form-control" id="posicao" name="posicao" required>
                </div>

                <div class="form-group">
                  <label for="pontos_posicao">Pontos</label>
                  <input type="text" class="form-control" id="pontos_posicao" name="pontos_posicao"  required>
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