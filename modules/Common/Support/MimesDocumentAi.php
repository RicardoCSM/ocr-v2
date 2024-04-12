<?php

namespace Modules\Common\Support;

enum MimesDocumentAi: string
{
    case PDF = 'pdf';
    case GIF = 'gif';
    case TIFF = 'tiff';
    case JPEG = 'jpeg';
    case PNG = 'png';
    case BMP = 'bmp';
    case WEBP = 'webp';
}