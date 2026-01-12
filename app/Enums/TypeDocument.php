<?php
namespace App\Enums;

enum TypeDocument: string
{
    case SOAT = 'Soat Vehicular';
    case REVISION = 'Revisión técnica vehicular';
    case TARJETA = 'Tarjeta de propiedad';
    case POLARIZADAS = 'Lunas polarizadas';
    case CERTIFICADO= 'Certificado GLP';
    case CIRCULACION='Tarjeta de circulación';

}
