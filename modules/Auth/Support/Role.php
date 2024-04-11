<?php

namespace Modules\Auth\Support;

enum Role: string
{
    case DEFAULT = 'default';
    case ADMIN = 'admin';
}