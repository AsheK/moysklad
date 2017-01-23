<?php

namespace MoySklad\Entities\Products;
use MoySklad\Components\Specs\CreationSpecs;
use MoySklad\Components\Specs\LinkingSpecs;
use MoySklad\Entities\Misc\Characteristics;
use MoySklad\Lists\EntityList;
use MoySklad\Traits\DoesCreation;

class Variant extends AbstractProduct{
    use DoesCreation;
    public static
        $entityName = 'variant';

    /**
     * @param Product $product
     * @param EntityList $characteristics
     */
    public function setupCreate(Product $product, EntityList $characteristics, CreationSpecs $specs = null){
        if ( empty($specs) ) $specs = CreationSpecs::create();
        $this->links->link($product);
        $characteristics->each(function(Characteristics $ch){
            $this->links->link($ch, LinkingSpecs::create([
                "multiple" => true
            ]));
        });
    }
}