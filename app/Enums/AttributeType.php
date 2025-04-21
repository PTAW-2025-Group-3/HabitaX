<?php

namespace App\Enums;

enum AttributeType: string
{
    case INT = 'int';
    case FLOAT = 'float';
    case TEXT = 'text';
    case LONG_TEXT = 'long_text';
    case BOOLEAN = 'boolean';
    case DATE = 'date';
    case SELECT_SINGLE = 'select_single';
    case SELECT_MULTIPLE = 'select_multiple';
}
