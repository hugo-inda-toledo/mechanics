<?php
namespace Ideauno;


// Para devolver nombre
abstract class BaseEnum{
    private final function __construct(){ }

    public static function toString($val){
        $tmp = new \ReflectionClass(get_called_class());
        $a = $tmp->getConstants();
        $b = array_flip($a);
        return strtoupper(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1 ', $b[$val]));
    }
}

// enumeracion para los estados de las solicitudes.
abstract class RequestStatus extends BaseEnum
{
   const Abierta           =  1; // recien creada
   const EnCurso           =  2; // presiona start
   const AnuladaCliente    =  3;
   const AnuladaMecanico   =  4;
   const Finalizada        =  5; // presiona finish
   const EnEsperaTrabajo   =  6; // solicitud pagada y asignada a un mecánico
   const Pagado            =  7; // se publica a los mecánicos
   const EnEsperaPago      =  8; // sin publicar
   const ModMecanico       =  9; // mecanico hizo modificaciones, se está en espera de que cliente las acepte o rechaze.
   const EnEsperaraPagoMod =  10; // mecanico hizo modificaciones y cliente las acepto, se está en espera de que el cliente page
   const RequiereInspeccion=  11;
}

// enumeracion para los estados de las solicitudes de mods de mecanico.
abstract class ServicesModStatus extends BaseEnum
{
   const EsperandoAprob    =  1; // recien creada
   const Aprobada          =  2;
   const Anulada           =  3;
   const Pagado            =  4;
}

abstract class UserRoles extends BaseEnum
{
  const Super_Admin       = 1;
  const Admin_Basico      = 2;
  const Admin_Medio       = 3;
  const Admind_Avanzado   = 4;
  const Cliente           = 5;
  const Mecanico          = 6;
}
