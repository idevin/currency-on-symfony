<?php

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency {
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(targetEntity: Data::class, mappedBy: 'currency')]
    #[ORM\OrderBy(['code' => 'ASC'])]
    private Data $data;

    #[ORM\Column(length: 255)]
    private ?string $symbol = null;

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getSymbol(): ?string {
        return $this->symbol;
    }

    public function setSymbol(?string $symbol): void {
        $this->symbol = $symbol;
    }

    public function getData(): Data {
        return $this->data;
    }

    public function setData(Data $data): void {
        $this->data = $data;
    }
}
