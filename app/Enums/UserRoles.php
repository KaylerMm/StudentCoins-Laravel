<?php

namespace App\Enums;

enum UserRoles: string
{
    case STUDENT = 'student';
    case TEACHER = 'teacher';
    case PARTNER = 'partner';

    public static function values(): array
    {
        return [
            self::STUDENT,
            self::TEACHER,
            self::PARTNER,
        ];
    }

    public static function getDescription($value): string
    {
        return match ($value) {
            self::STUDENT => 'Aluno',
            self::TEACHER => 'Professor',
            self::PARTNER => 'Empresa Parceira',
            default => 'Desconhecido',
        };
    }
}