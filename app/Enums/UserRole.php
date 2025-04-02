<?php
namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'admin';
    case TEAM_MEMBER = 'team_member';
}