<?php

namespace App\Entity;

class PropertySearch {

    /**
     * @var string|null
     */
    private $name;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return PropertySearch
     */
    public function setName(?string $name): PropertySearch
    {
        $this->name = $name;
        return $this;
    }

}