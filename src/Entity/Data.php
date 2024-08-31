<?php

namespace App\Entity;

use App\Repository\DataRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DataRepository::class)]
class Data {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: Currency::class, inversedBy: 'data')]
    private Currency $currency;

    #[ORM\Column(length: 255)]
    private ?string $symbol = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    public ?string $symbol_native = null;

    #[ORM\Column(length: 255)]
    public ?string $decimal_digits = null;

    #[ORM\Column]
    private ?int $rounding = null;

    #[ORM\Column(length: 255)]
    public ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $name_plural = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(type: "float", scale: 5, nullable: true)]
    public ?float $value = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function getSymbol(): ?string {
        return $this->symbol;
    }

    public function setSymbol(string $symbol): static {
        $this->symbol = $symbol;

        return $this;
    }

    public function getName(): ?string {
        return $this->name;
    }

    public function setName(string $name): static {
        $this->name = $name;

        return $this;
    }

    public function getSymbolNative(): ?string {
        return $this->symbol_native;
    }

    public function setSymbolNative(string $symbol_native): static {
        $this->symbol_native = $symbol_native;

        return $this;
    }

    public function getDecimalDigits(): ?string {
        return $this->decimal_digits;
    }

    public function setDecimalDigits(string $decimal_digits): static {
        $this->decimal_digits = $decimal_digits;

        return $this;
    }

    public function getRounding(): ?int {
        return $this->rounding;
    }

    public function setRounding(int $rounding): static {
        $this->rounding = $rounding;

        return $this;
    }

    public function getCode(): ?string {
        return $this->code;
    }

    public function setCode(string $code): static {
        $this->code = $code;

        return $this;
    }

    public function getNamePlural(): ?string {
        return $this->name_plural;
    }

    public function setNamePlural(string $name_plural): static {
        $this->name_plural = $name_plural;

        return $this;
    }

    public function getType(): ?string {
        return $this->type;
    }

    public function setType(string $type): static {
        $this->type = $type;

        return $this;
    }

    public function getCurrency(): Currency {
        return $this->currency;
    }

    public function setCurrency(Currency $currency): void {
        $this->currency = $currency;
    }

    public function getValue(): ?string {
        return $this->value;
    }

    public function setValue(?string $value): void {
        $this->value = $value;
    }
}
