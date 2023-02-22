<?php

namespace App\Core;

enum MessageType : string
{
    case Success = "success";
    case Error = "danger";
    case Warning = "warning";
}
