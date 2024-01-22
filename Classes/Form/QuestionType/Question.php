<?php
declare(strict_types=1);
namespace Form\QuestionType;

use Form\GenericQuestionElement;

abstract class Question extends GenericQuestionElement
{
    public function render(): string
    {
        return sprintf(
            '<input type="%s" %s value="%s" name="form[%s]" id="%s"/>', 
            $this->type,
            $this->isRequired() ? 'required="required"' : '',
            $this->getValue(),
            $this->getName(),
            $this->getId()
        );
    }
}