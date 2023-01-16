<?php declare(strict_types=1);

namespace Tests\Mercadona\Domain\Category;

use Mercadona\Domain\Product\Product;
use Mercadona\Domain\Product\ProductId;
use Mercadona\Domain\Product\ProductName;
use Mercadona\Domain\Photo\PhotoCollection;
use Mercadona\Domain\Price\PriceCollection;
use Tests\Mercadona\Domain\Product\ProductExample;
use Mercadona\Domain\Category\CategoryIdCollection;
use Tests\Mercadona\Domain\Photo\PhotoExample;
use Tests\Mercadona\Domain\Price\PriceExample;
use Tests\TestCase;

final class ProductTest extends TestCase 
{
    public function testProductId(): void
    {
        $product = ProductExample::dummy();
        $this->assertInstanceOf(ProductId::class, $product->id());
        $this->assertEquals(1, $product->id()->value());
    }
    
    public function testProductName(): void
    {
        $product = ProductExample::dummy();
        $this->assertInstanceOf(ProductName::class, $product->name());
        $this->assertEquals("Dummy Product", $product->name()->value());
    }
    
    public function testEan(): void
    {
        $product = ProductExample::dummy();
        $this->assertNull($product->ean());
    }

    public function testSlug(): void
    {
        $product = ProductExample::dummy();
        $this->assertNull($product->slug());
    }
    
    public function testBrand(): void
    {
        $product = ProductExample::dummy();
        $this->assertIsString($product->brand());
        $this->assertEquals("Dummy Brand", $product->brand());
    }
    
    public function testLimit(): void
    {
        $product = ProductExample::dummy();
        $this->assertIsInt($product->limit());
        $this->assertEquals(10, $product->limit());
    }
    
    public function testOrigin(): void
    {
        $product = ProductExample::dummy();
        $this->assertIsString($product->origin());
        $this->assertEquals("Dummy Origin", $product->origin());
    }
    
    public function testPackaging(): void
    {
        $product = ProductExample::dummy();
        $this->assertIsString($product->packaging());
        $this->assertEquals("Dummy Packaging", $product->packaging());
    }
    
    public function testPublished(): void
    {
        $product = ProductExample::dummy();
        $this->assertIsBool($product->published());
        $this->assertTrue($product->published());
    }
    
    public function testShareUrl(): void
    {
        $product = ProductExample::dummy();
        $this->assertIsString($product->shareUrl());
        $this->assertEquals("dummy-product", $product->shareUrl());
    }
    
    public function testThumbnail(): void
    {
        $product = ProductExample::dummy();
        $this->assertIsString($product->thumbnail());
        $this->assertEquals("dummy-thumbnail.jpg", $product->thumbnail());
    }

    public function testIsVariableWeight(): void
    {
        $product = ProductExample::dummy();
        $this->assertNull($product->isVariableWeight());
    }
    
    public function testCategoryIds(): void
    {
        $product = ProductExample::dummy();
        $this->assertInstanceOf(CategoryIdCollection::class, $product->categoryIds());
    }
    
    public function testPrices(): void
    {
        $product = ProductExample::dummy();
        $this->assertInstanceOf(PriceCollection::class, $product->prices());
    }
    
    public function testPhotos(): void
    {
        $product = ProductExample::dummy();
        $this->assertInstanceOf(PhotoCollection::class, $product->photos());
    }

    public function testModifyCategoryIds(): void
    {
        $product = ProductExample::dummy();
        $categoryIds = new CategoryIdCollection([
            CategoryIdExample::random(),
            CategoryIdExample::random(),
            CategoryIdExample::random()
        ]);
        $product->modifyCategoryIds($categoryIds);
        $this->assertEquals($categoryIds, $product->categoryIds());
    }
    
    public function testModifyPrices(): void
    {
        $product = ProductExample::dummy();
        $prices = new PriceCollection([
            PriceExample::random(),
            PriceExample::random(),
            PriceExample::random()
        ]);
        $product->modifyPrices($prices);
        $this->assertEquals($prices, $product->prices());
    }
    
    public function testHasPrices(): void
    {
        $product = ProductExample::dummy();
        $this->assertTrue($product->hasPrices());
        $product->modifyPrices(PriceCollection::empty());
        $this->assertFalse($product->hasPrices());
    }

    public function testModifyPhotos(): void
    {
        $product = ProductExample::dummy();
        $photos = new PhotoCollection([
            PhotoExample::random(),
            PhotoExample::random(),
        ]);
        $product->modifyPhotos($photos);
        $this->assertEquals($photos, $product->photos());
    }

    public function testProductCanBeCreatedWithDummyValues(): void
    {
        $product = ProductExample::dummy();

        $this->assertInstanceOf(Product::class, $product);
        $this->assertEquals(1, $product->id()->value());
        $this->assertEquals("Dummy Product", $product->name()->value());
        $this->assertEquals(null, $product->ean());
        $this->assertEquals(null, $product->slug());
        $this->assertEquals("Dummy Brand", $product->brand());
        $this->assertEquals(10, $product->limit());
        $this->assertEquals("Dummy Origin", $product->origin());
        $this->assertEquals("Dummy Packaging", $product->packaging());
        $this->assertTrue($product->published());
        $this->assertEquals("dummy-product", $product->shareUrl());
        $this->assertEquals("dummy-thumbnail.jpg", $product->thumbnail());
        $this->assertEquals(null, $product->isVariableWeight());
        $this->assertInstanceOf(CategoryIdCollection::class, $product->categoryIds());
        $this->assertInstanceOf(PriceCollection::class, $product->prices());
        $this->assertInstanceOf(PhotoCollection::class, $product->photos());
    }

    public function testProductCanBeCreatedWithRandomValues(): void
    {
        $product = ProductExample::random();

        $this->assertInstanceOf(Product::class, $product);
        $this->assertInstanceOf(ProductId::class, $product->id());
        $this->assertInstanceOf(ProductName::class, $product->name());
        $this->assertIsInt($product->ean());
        $this->assertIsString($product->slug());
        $this->assertIsString($product->brand());
        $this->assertIsInt($product->limit());
        $this->assertIsString($product->origin());
        $this->assertIsString($product->packaging());
        $this->assertIsBool($product->published());
        $this->assertIsString($product->shareUrl());
        $this->assertIsString($product->thumbnail());
        $this->assertIsString($product->isVariableWeight());
        $this->assertInstanceOf(CategoryIdCollection::class, $product->categoryIds());
        $this->assertInstanceOf(PriceCollection::class, $product->prices());
        $this->assertInstanceOf(PhotoCollection::class, $product->photos());
    }

}