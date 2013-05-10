@extends('layouts.main')

@section('breadcrumbs', Breadcrumbs::render('funcionario.edit',$funcionario))

@section('content')

    <h1>{{$funcionario->nome}}</h1>
    <table class="table table-bordered">
        <tr  class="warning">
            <td width="25px"></td>
            <td >
            <br>
            {{ Form::model($funcionario, array('method' => 'PUT', 'class' => 'bs-docs-example', 'route' => ['funcionarios.update',$funcionario->id])) }}
                <fieldset>
                    <div class="input-append">
                      {{ Form::text('matricula', null, ['class' => 'span4', 'id' => 'prependedDropdownButton']) }}
                      <span class="add-on">Matrícula</span>
                    </div>

                    <br>

                    <div class="input-append">
                        {{ Form::text('nome', null, ['class' => 'span4']) }}
                        <span class="add-on">Nome</span>
                    </div>

                    <br>
                    
                    <div class="input-append">
                        {{ Form::text('divisao', null, ['class' => 'span4']) }}
                        <span class="add-on">Divisão</span>
                    </div>

                    <br>
                    
                    <div class="input-append">
                        {{ Form::text('usuario', null, ['class' => 'span4']) }}
                        <span class="add-on">Usuário</span>
                    </div>

                    <br>
                    
                    <div class="input-append">
                        {{ Form::text('email', null, ['class' => 'span4']) }}
                        <span class="add-on">E-mail</span>
                    </div>

                    <br>
                    
                    <div class="input-append">
                        {{ Form::text('ramal', null, ['class' => 'span4']) }}
                        <span class="add-on">Ramal</span>
                    </div>

                    <br>
                    
                    <div class="input-append">
                        {{ Form::text('ramal_movel', null, ['class' => 'span4']) }}
                        <span class="add-on">Ramal móvel</span>
                    </div>

                    <br>
                    
                    <div class="input-append">
                        {{ Form::text('residencia', null, ['class' => 'span4']) }}
                        <span class="add-on">Residência</span>
                    </div>

                    <br>
                    
                    <div class="input-append">
                        {{ Form::text('celular', null, ['class' => 'span4']) }}
                        <span class="add-on">Celular</span>
                    </div>

                    <br>
                    
                    <div class="input-append">
                        {{ Form::text('horario_limite', null, ['class' => 'span4']) }}
                        <span class="add-on">Hora saída</span>
                    </div>

                    <br><br>
                    
                    <button type="submit" class="btn btn-primary">Gravar</button>
                </fieldset>
            {{ Form::close() }}
        </td></tr>
    </table>
@stop
