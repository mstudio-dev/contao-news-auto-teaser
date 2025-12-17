<?php
namespace Mstudio\NewsAutoTeaserBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Mstudio\NewsAutoTeaserBundle\MstudioNewsAutoTeaserBundle;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(MstudioNewsAutoTeaserBundle::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}