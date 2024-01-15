<?php

declare(strict_types=1);
namespace Form;
use Form\InputType\InputRender;

abstract class GenericFormElement implements InputRender
{
    protected string $type;
    protected bool $required = false;
    protected mixed $value = '';
    protected string $id = '';

    public function __construct(
        protected readonly string $name, // Readonly cause property is immutable
        $required = false, 
        string $defaultValue = '',
        $id = ''
    )
    {
        $this->required = $required;
        $this->value = $defaultValue;
        $this->id = $id;
    }


    public function __toString(): string
    {
        return $this->render();
    }

    function getId(): string 
    {
        return $this->id;
    }

    function getName(): string 
    {
        return $this->name;
    }

    function getValue(): array|string 
    {
        return $this->value;
    }

    function isRequired(): bool
    {
        return $this->required;
    }
}
?>