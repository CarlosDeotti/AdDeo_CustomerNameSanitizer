<?php
/**
 * @author    Carlos Deotti <deotti@gmail.com>
 * @copyright 2026 AdDeo
 */
declare(strict_types=1);

use Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    ComponentRegistrar::MODULE,
    'AdDeo_CustomerNameSanitaizer',
    __DIR__
);
