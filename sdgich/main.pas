unit main;

interface

uses
  Windows, Messages, SysUtils, Variants, Classes, Graphics, Controls, Forms,
  Dialogs, StdCtrls, WinInet;

const
  NOTIFY_FOR_ALL_SESSIONS  = 1;
  NOTIFY_FOR_THIS_SESSIONS = 0;

type
  TForm1 = class(TForm)
    events: TListBox;
    userName: TLabel;
    procedure FormShow(Sender: TObject);
    procedure FormCreate(Sender: TObject);
    procedure FormClose(Sender: TObject; var Action: TCloseAction);
  private
    fMsgHandlerHWND : HWND;
    FRegisteredSessionNotification : Boolean;
    FintLockedCount: Integer;
    procedure AppMessage(var Msg: TMSG; var Handled: Boolean);
    function isConsole: boolean;
    function getConsole: string;
    function WebGetData(const UserAgent, URL: string): string;
    procedure event(what: string);
    procedure logout(var Msg: TMessage); message WM_ENDSESSION;
  public
  end;

function WTSRegisterSessionNotification(hWnd: HWND; dwFlags: DWORD): BOOL; stdcall;
function WTSUnRegisterSessionNotification(hWND: HWND): BOOL; stdcall;
function AppIsAlreadyRunning(const sUniqueText: String): Boolean;

var
  Form1: TForm1;

implementation

function WTSRegisterSessionNotification;
  external 'wtsapi32.dll' Name 'WTSRegisterSessionNotification';

function WTSUnRegisterSessionNotification;
  external 'wtsapi32.dll' Name 'WTSUnRegisterSessionNotification';

{$R *.dfm}

Function GetUserFromWindows: string;
Var
   UserName : string;
   UserNameLen : Dword;
Begin
   UserNameLen := 255;
   SetLength(userName, UserNameLen) ;
   If GetUserName(PChar(UserName), UserNameLen) Then
     Result := Copy(UserName,1,UserNameLen - 1)
   Else
     Result := 'Unknown';
End;

procedure TForm1.FormShow(Sender: TObject);
begin
  userName.caption := GetUserFromWindows() + ' - ' + getConsole();
end;

procedure TForm1.AppMessage(var Msg: TMSG; var Handled: Boolean);
var
  strReason: string;
  sConsole : string;
begin
  Handled := False;

  if Msg.Message = WM_WTSSESSION_CHANGE then
  begin
     case Msg.wParam of
       WTS_SESSION_LOGON:
           strReason := 'logon';
       WTS_SESSION_LOGOFF:
           strReason := 'logout';
       WTS_SESSION_LOCK:
           strReason := 'lock';
       WTS_SESSION_UNLOCK:
           strReason := 'unlock';
     end;

     event(strReason);
  end;
end;

procedure TForm1.event(what : string);
var
  eventUrl : string;
begin
  events.Items.Add(DateTimeToStr(Now()) + ' ' + ' - ' + GetUserFromWindows() + ' - ' + what + ' - ' + getConsole());

  //  eventUrl := 'http://10.17.12.250/controleDeHoras.development/event/K234092O35g4hjP2kl12bx1cv3bn6mAo4uhkjhwekZ/'+GetUserFromWindows()+'/'+getConsole()+'/'+what;
  eventUrl := 'http://horas.alerj.gov.br/event/K234092O35g4hjP2kl12bx1cv3bn6mAo4uhkjhwekZ/'+GetUserFromWindows()+'/'+getConsole()+'/'+what;

  WebGetData('controleDeHoras', eventUrl);
end;


function TForm1.isConsole : boolean;
const
  sm_RemoteSession = $1000;
begin
  result := GetSystemMetrics(sm_RemoteSession) = 0;
end;

function TForm1.getConsole : string;
begin
     if (isConsole()) then begin
       Result := 'local';
     end else begin
       Result := 'remote'
     end;
end;

procedure TForm1.FormCreate(Sender: TObject);
begin
  Application.ShowMainForm := false;
  
  Application.OnMessage := AppMessage;
  WTSRegisterSessionNotification(Handle, NOTIFY_FOR_ALL_SESSIONS);

  event('open');
end;

function TForm1.WebGetData(const UserAgent: string; const URL: string): string;
var
  hInet: HINTERNET;
  hURL: HINTERNET;
  Buffer: array[0..1023] of AnsiChar;
  BufferLen: cardinal;
begin
  result := '';
  hInet := InternetOpen(PChar(UserAgent), INTERNET_OPEN_TYPE_PRECONFIG, nil, nil, 0);
  if hInet = nil then RaiseLastOSError;
  try
    hURL := InternetOpenUrl(hInet, PChar(URL), nil, 0, 0, 0);
    if hURL = nil then RaiseLastOSError;
    try
      repeat
        if not InternetReadFile(hURL, @Buffer, SizeOf(Buffer), BufferLen) then
          RaiseLastOSError;
        result := result + UTF8Decode(Copy(Buffer, 1, BufferLen))
      until BufferLen = 0;
    finally
      InternetCloseHandle(hURL);
    end;
  finally
    InternetCloseHandle(hInet);
  end;
end;

procedure TForm1.FormClose(Sender: TObject; var Action: TCloseAction);
begin
  event('close');
end;

procedure TForm1.logout;
begin
  event('logout');
end;

function AppIsAlreadyRunning(const sUniqueText: String): Boolean;
begin
  // If the named Mutex already exists, there's another copy running.

  if OpenMutex(MUTEX_ALL_ACCESS,False,PChar(sUniqueText)) <> 0 then
    Result := True
  else
  Result := (CreateMutex(nil,False,PChar(sUniqueText)) = 0);
  // Otherwise, create a Mutex with a unique name.
  // This should succeed, unless we're out of resources.

  // Mutex handle is closed automatically when the process terminates.
  // Mutex is destroyed when the last handle to it is closed.
end;

end.
