<?php

namespace App;

enum AttributeType: string
{
    case INTEGER = 'integer';
    case REAL = 'real';
    case TEXT = 'text';
    case BOOLEAN = 'boolean';
    case SELECT = 'select';
    case DATE = 'date';
}
