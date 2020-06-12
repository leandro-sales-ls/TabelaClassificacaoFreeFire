@extends('layouts.app', ['activePage' => 'pontoKill', 'titlePage' => __('Cadastrar Pontos por Kill')])


@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <a href="/ponto-kill"><button class="btn btn-secondary">Voltar</button></a>
        </div>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Cadastrar Pontos por Kill</h4>
            <p class="card-category"></p>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <br>
              <form action="ponto-kill-create" method="POST">
               
                {{csrf_field()}}

                {{-- <div class="form-group">
                  <label for="id_temporara">Temporada</label> 
                  <select name="id_temporara" class="custom-select" required>
                    <option disabled selected>Selecione um Time</option>

                    @foreach ($temporadas as $temporada)
                      <option value="{{$temporada->id}}">{{$temporada->nome_temporada}}</option>
                    @endforeach

                  </select>
                </div> --}}

                <p style="{ margin-top: 3cm; }"></p>

                <div class="form-group">
                  <label for="num_kill">Numero Kill</label>
                  <input type="text" class="form-control" id="num_kill" name="num_kill" required>
                </div>

                <div class="form-group">
                  <label for="ponto_kill">Pontos</label>
                  <input type="text" class="form-control" id="ponto_kill" name="ponto_kill"  required>
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