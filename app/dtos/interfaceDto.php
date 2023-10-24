<?php

namespace App\dtos;

interface interfaceDto
{
    public function toJson();
    public function toModel();
    public function toArray();
}
