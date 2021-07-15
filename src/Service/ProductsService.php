<?php

namespace LukaPeharda\PayPal\Service;

use LukaPeharda\PayPal\Catalog\Product;

class ProductsService extends AbstractService
{
    /**
     * Returns an array with products on PayPal.
     *
     * @return  mixed
     */
    public function all()
    {
        $response = $this->request('get', '/v1/catalogs/products');

        if ($response->result === null) {
            return [];
        }

        return array_map(function ($product) {
            return Product::fromArray((array) $product);
        }, $response->result->products);
    }

    /**
     * Persist a product on PayPal.
     *
     * @param   Product  $product
     *
     * @return  Product
     */
    public function create(Product $product)
    {
        $response = $this->request('post', '/v1/catalogs/products', $product->toArray());

        return Product::fromArray((array) $response->result);
    }

    /**
     * Update a product on PayPal.
     *
     * @param   Product  $product
     *
     * @return  void
     */
    public function update(Product $product)
    {
        $response = $this->request('patch', '/v1/catalogs/products/' . $product->getId(), [
            [
                'op' => 'replace',
                'path' => '/name',
                'value' => $product->getName(),
            ],
            [
                'op' => 'replace',
                'path' => '/description',
                'value' => $product->getDescription(),
            ],
        ]);

        return $this->retrieve($product->getId());
    }

    /**
     * Fetch a product from PayPal.
     *
     * @param   string  $id
     *
     * @return  Product
     */
    public function retrieve($id)
    {
        $response = $this->request('get', '/v1/catalogs/products/' . $id);

        return Product::fromArray((array) $response->result);
    }
}
