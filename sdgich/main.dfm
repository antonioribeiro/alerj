object Form1: TForm1
  Left = 606
  Top = 339
  Width = 597
  Height = 521
  Caption = 'Controle De Horas'
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  OnClose = FormClose
  OnCreate = FormCreate
  OnShow = FormShow
  PixelsPerInch = 96
  TextHeight = 13
  object userName: TLabel
    Left = 8
    Top = 8
    Width = 72
    Height = 16
    Caption = 'userName'
    Font.Charset = DEFAULT_CHARSET
    Font.Color = clWindowText
    Font.Height = -13
    Font.Name = 'MS Sans Serif'
    Font.Style = [fsBold]
    ParentFont = False
  end
  object events: TListBox
    Left = 8
    Top = 32
    Width = 577
    Height = 425
    ItemHeight = 13
    TabOrder = 0
  end
end
