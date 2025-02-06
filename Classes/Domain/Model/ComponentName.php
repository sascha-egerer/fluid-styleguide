<?php
declare(strict_types=1);

namespace Sitegeist\FluidStyleguide\Domain\Model;

use Sitegeist\FluidStyleguide\Domain\Model\Package;

class ComponentName
{
    public function __construct(
        protected string $name,
        protected Package $package,
    ) {
        $this->name = trim($name, '\\');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getIdentifier(): string
    {
        return $this->package->getNamespace() . '\\' . $this->name;
    }

    public function getDisplayName(): string
    {
        return str_replace('\\', '/', $this->name);
    }

    public function getSimpleName(): string
    {
        return array_pop(explode('\\', $this->name));
    }

    public function getTagName(): string
    {
        $tagName = implode('.', array_map('lcfirst', explode('\\', $this->name)));
        return $this->package->getAlias() . ':' . $tagName;
    }

    public function getPackage(): Package
    {
        return $this->package;
    }
}
