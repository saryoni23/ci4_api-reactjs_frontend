<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\RequestTrait;
use App\Models\ProductModel;
use CodeIgniter\HTTP\Response;

class Products extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use RequestTrait;
    public function index()
    {
        $model = new ProductModel();
        $products = $model->findAll();
        return $this->respond($products);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $model = new ProductModel();
        $product = $model->find(['id' => $id]);
        if (!$product) {
            return $this->failNotFound('Product not found');
        };
        return $this->respond($product[0]);
    }

    /**
     * Return a new resource object, with default properties
     *
     
     * @return mixed
     */
    public function create()
    {
        helper(['form']);
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ];
        $product = [
            'name' => $this->request->getVar('name'),
            'price' => $this->request->getVar('price'),
            'qty' => $this->request->getVar('qty'),
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new ProductModel();
        $model->insert($product);
        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                'success' => 'Product created',
            ]
        ];
        return $this->respondCreated('$response');
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */

    public function update($id = null)
    {
        helper(['form']);
        $rules = [
            'name' => 'required',
            'price' => 'required',
            'qty' => 'required',
        ];
        $product = [
            'name' => $this->request->getVar('name'),
            'price' => $this->request->getVar('price'),
            'qty' => $this->request->getVar('qty'),
        ];
        if (!$this->validate($rules)) return $this->fail($this->validator->getErrors());
        $model = new ProductModel();
        $findbyid = $model->find(['id' => $id]);
        if (!$findbyid) {
            return $this->failNotFound('Product not found');
        };
        $model->update($id, $product);
        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                'success' => 'Product updated',
            ]
        ];
        return $this->respond('$response');
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $model = new ProductModel();
        $findbyid = $model->find(['id' => $id]);
        if (!$findbyid) {
            return $this->failNotFound('Product not found');
        };
        $model->delete($id);
        $response = [
            'status' => 201,
            'error' => null,
            'message' => [
                'success' => 'Product deleted',
            ]
        ];
        return $this->respond('$response');
    }
}
