<?php

namespace App\Model;

use App\Constants\Constants;
use App\Currencies\Money;

class Product
{
    private string $code;
    private string $name;
    private int $quantity;
    private string $price;
    private string $currency;
    private ?Money $money;

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getPrice(): string
    {
        return $this->price;
    }

    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function getMoney(): ?Money
    {
        return $this->money;
    }

    public function setMoney(?Money $money): void
    {
        $this->money = $money;
    }

    public function isValid(): bool
    {
        if (empty($this->getCode())) {
            return false;
        }
        if (empty($this->getName())) {
            return false;
        }
        if (empty($this->getQuantity())) {
            return false;
        }

        if ($this->getQuantity() < 0) {
            return true;
        }

        if (!in_array($this->getCurrency(), Constants::SUPPORTED_CURRENCIES)) {
            return false;
        }
        if (!preg_match(Constants::CURRENCY_VALIDATION_REGEX, $this->getPrice())) {
            return false;
        }

        return true;
    }
}