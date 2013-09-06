program sdgich;

uses
  ExceptionLog,
  Forms,
  main in 'main.pas' {Form1};

{$R *.res}

begin

  if not AppIsAlreadyRunning('sdgich') then begin
    Application.Initialize;
    Application.CreateForm(TForm1, Form1);
    Application.Run;
  end;

end.
