@if($funcionario->isLoggedIn())
	<a toggleUserId="{{$funcionario->id}}" toggleConfirmationMessage="Confirma a SAÍDA do funcionário {{$funcionario->nome}}?" href="{{URL::route('horas.toggle', array('funcionarioId' => $funcionario->id))}}" onClick="return false;" class="btn btn-success">Informar SAÍDA</a>
@else
	<a toggleUserId="{{$funcionario->id}}" toggleConfirmationMessage="Confirma a CHEGADA do funcionário {{$funcionario->nome}}?" href="{{URL::route('horas.toggle', array('funcionarioId' => $funcionario->id))}}" onClick="return false;" class="btn btn-danger">Informar CHEGADA</a>
@endif
