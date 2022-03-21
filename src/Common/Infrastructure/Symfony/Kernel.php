<?php

namespace App\Common\Infrastructure\Symfony;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

/** @psalm-immutable */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;
}
