unit uevent_incrementargold;

{$mode objfpc}{$H+}

interface

uses
  Classes, SysUtils, uconexionBD;
type
  TIncrementarGold = class
    Procedure Ejecutar(conn:TConexionBD);
    Constructor create();
    Destructor destroy; override;
    Procedure IncrementarOro(usuario:string; oroInicial:integer; OroAIncrementar:integer; conn:TConexionBD);
  end;

implementation
 uses
   ZDataset, ulog, utiles;

 Procedure  TIncrementarGold.Ejecutar(conn:TConexionBD);
 var
  ZQuery_lista_usuarios, Zquery_Config, Zquery_Sumar_oro: TZQuery;
  usuario:string;
  oroaIncrementar:integer;
  oroInicial:integer;
  vlog:Tlog;
 begin

   vlog:=Tlog.create('mylogs.log','/usr/sbin/crow/',false);
   vlog.info('Evento: Incrementando oro');

   //Buscando oro a incrementar
   Zquery_Config:=TZquery.Create(nil);
   Zquery_Config.Connection:=conn.mConexxion;
   Zquery_Config.sql.add('Select * from config');
   Zquery_Config.open;
   oroaIncrementar:=Zquery_Config.fieldByname('gold_increment').asInteger;
   Zquery_Config.Close;
   Zquery_Config.Connection:=nil;
   Zquery_Config.free;




   //Recorriendo los usuarios: TODO: una sola consulta
   Zquery_lista_usuarios:=TZquery.Create(nil);
   ZQuery_lista_usuarios.Connection:=conn.mConexxion;
   Zquery_lista_usuarios.sql.add('select * from user where role<>:role');   //where role<>ROLE_ADMIN
   ZQuery_lista_usuarios.ParamByName('role').AsString:='ROLE_ADMIN';
   ZQuery_lista_usuarios.Open;


   while not ZQuery_lista_usuarios.eof do begin
      usuario:= Zquery_lista_usuarios.fieldbyname('name').AsString;
      oroInicial := Zquery_lista_usuarios.fieldbyname('gold').AsInteger;


      vlog.info('Incrementando oro a '+usuario);

       IncrementarOro(usuario,oroInicial,oroaIncrementar,conn);





     ZQuery_lista_usuarios.next;
   end;






   Zquery_lista_usuarios.close;
   Zquery_lista_usuarios.Connection:=nil;
   ZQuery_lista_usuarios.Free;



   vlog.free;



 end;

 Procedure TIncrementarGold.IncrementarOro(usuario:string; oroInicial:integer; OroAIncrementar:integer; conn:TConexionBD);
 var
  Zquery:TZquery;
  OroFinal:integer;
 begin

   OroFinal:=OroInicial + OroAIncrementar;

   Zquery:=TZquery.Create(nil);
   ZQuery.Connection:=conn.mConexxion;
   Zquery.sql.add('update user set gold=:oro_final where name=:nombre');
   Zquery.ParamByName('oro_final').AsInteger:=OroFinal;
      Zquery.ParamByName('nombre').ASSTring:=usuario;
   ZQuery.ExecSQL;

   Zquery.close;
   Zquery.Connection:=nil;
   ZQuery.Free;

 end;

//Mover a utiles
 Procedure ActualizarFechasEventos(codigo_evento_tipo_evento:integer; conn:TConexionBD);
 begin

 end;

 Constructor    TIncrementarGold.Create();
 begin

 end;

 Destructor TIncrementarGold.destroy();
 begin

 end;

end.

