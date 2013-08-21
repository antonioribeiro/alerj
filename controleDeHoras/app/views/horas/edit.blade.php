@extends('layouts.main')

@section('breadcrumbs', Breadcrumbs::render('horas.edit',$funcionario))

@section('content')

    <h1>{{$funcionario->nome}}</h1>
    <h4>{{Tools::date($hora->hora_entrada)}}</h4>
    <table class="table table-bordered">
        <tr  class="warning">
            <td width="25px"></td>
            <td >
            <br>
            {{ Form::model($hora, array('method' => 'PUT', 'class' => 'bs-docs-example', 'route' => ['horas.update',$hora->id])) }}
                <fieldset>

                    <div class="input-append">
                      {{ Form::text('h_entrada', Tools::time(Form::getValueAttribute('hora_entrada')), ['class' => 'span4', 'id' => 'prependedDropdownButton']) }}
                      <span class="add-on">Entrada</span>
                    </div>

                    <br>

                    <div class="input-append">
                        {{ Form::text('h_saida', Tools::time(Form::getValueAttribute('hora_saida')), ['class' => 'span4']) }}
                        <span class="add-on">Saída</span>
                    </div>

                    <br>
                    
                    <div class="input-append">
                        {{ Form::text('descricao', null, ['class' => 'span4']) }}
                        <span class="add-on">Motivo da modificação ou descrição do evento</span>
                    </div>

                    <br><br>
                    
                    <button type="submit" class="btn btn-primary">Gravar</button>
                </fieldset>
            {{ Form::close() }}
        </td></tr>
    </table>
@stop
