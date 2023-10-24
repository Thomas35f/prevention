<?php

namespace App\dtos;


use Illuminate\Http\Request;

class CompanyDto extends Dto implements interfaceDto
{
    public function __construct(
        public readonly string $name,
        public readonly string $contact,
        public readonly string $address,
    ) {}

    public static function fromRequest(Request $request): Dto
    {
        return new self(...$request->all());
    }

    public function toJson()
    {
        // TODO: Implement toJson() method.
    }

    public function toModel()
    {
        // TODO: Implement toModel() method.
    }

    public function toArray()
    {
        // TODO: Implement toArray() method.
    }

    /**
     * Defines the default values for the properties of the DTO.
     */
    protected function defaults(): array
    {
        return [];
    }

    /**
     * Maps the DTO properties before the DTO export.
     */
    protected function mapBeforeExport(): array
    {
        return [];
    }
}
