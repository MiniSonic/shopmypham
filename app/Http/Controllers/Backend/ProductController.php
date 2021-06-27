<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\Base\BackendController;
use App\Model\Entities\Brand;
use App\Model\Entities\Category;
use App\Model\Entities\Product;
use App\Repositories\ProductRepository;
use App\Validators\ProductValidator;
use Illuminate\Support\Facades\File;

class ProductController extends BackendController
{
    public function __construct(ProductRepository $productRepository)
    {
        $this->setRepository($productRepository);
    }

    public function index()
    {
        $entities = Product::delFlagOn()->with('category');
        $categories = Category::delFlagOn()->get();

        $search = trimValuesArray(request()->all());
        if (arrayGet($search, 'category_id')) {
            $entities->where('category_id', arrayGet($search, 'category_id'));
        }

        if (arrayGet($search, 'name')) {
            $entities->where('name', 'like', '%' . arrayGet($search, 'name') . '%');
        }

        if (arrayGet($search, 'id')) {
            $entities->where('id', arrayGet($search, 'id'));
        }

        if (arrayGet($search, 'hot')) {
            $entities->where('hot', arrayGet($search, 'hot'));
        }

        $entities = $entities->orderBy('id', 'desc')->paginate(getBackendPagination());

        $viewData = [
            'entities' => $entities,
            'categories' => $categories
        ];

        return view('backend.product.index', $viewData);
    }

    public function create()
    {
        $category = Category::delFlagOn()->get();

        $viewData = [
            'category' => $category
        ];

        return view('backend.product.create', $viewData);
    }

    public function store()
    {
        try {
            $params = request()->all();

            /** @var ProductValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->validateStoreProduct($params);

            if (!$isValid) {
                return redirect()->back()->withInput($params)->withErrors($validator->errors());
            }

            if (request()->hasFile('avatar')) {
                $fileName = time() . "_" . request()->file('avatar')->getClientOriginalName();
                $pathTmp = 'backend/uploads/product';
                $uploadPath = public_path($pathTmp); // Folder upload path

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                request()->file('avatar')->move($uploadPath, $fileName);
                $params['avatar'] = $pathTmp . '/' . $fileName;
            }
            $params['price_sell'] = arrayGet($params, 'price_origin') * (100 - arrayGet($params, 'sale')) / 100;
            $category = new Product();
            $category->fill($params);
            $category->save();
            return backRouteSuccess('backend.product.index', transMessage('create_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    public function edit($id)
    {
        try {
            $category = Category::delFlagOn()->get();
            $entity = Product::delFlagOn()->where('id', $id)->first();

            if (empty($entity)) {
                return backSystemError();
            }

            $viewData = [
                'entity' => $entity,
                'category' => $category,
            ];

            return view('backend.product.edit', $viewData);
        } catch (\Exception $e) {
            logError($e);
        }
        return backSystemError();
    }

    public function update($id)
    {
        try {
            $params = request()->all();

            $entity = Product::delFlagOn()->where('id', $id)->first();
            if (empty($entity)) {
                return backSystemError();
            }

            /** @var \App\Validators\ProductValidator $validator */
            $validator = $this->getRepository()->getValidator();
            $isValid = $validator->validateStoreProduct($params);

            if (!$isValid) {
                return redirect()->back()->withInput($params)->withErrors($validator->errors());
            }

            if (request()->hasFile('avatar')) {
                $fileName = time() . "_" . request()->file('avatar')->getClientOriginalName();
                $pathTmp = 'backend/uploads/product';
                $uploadPath = public_path($pathTmp); // Folder upload path

                if (!file_exists($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                request()->file('avatar')->move($uploadPath, $fileName);
                $params['avatar'] = $pathTmp . '/' . $fileName;

                // Remove old file
                $oldImage = $entity->avatar;
                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }
            $params['price_sell'] = arrayGet($params, 'price_origin') * (100 - arrayGet($params, 'sale')) / 100;
            $entity->fill($params);
            $entity->save();

            return backRouteSuccess('backend.product.index', transMessage('update_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }

    public function destroy($id)
    {
        try {
            $entity = Product::delFlagOn()->where('id', $id)->first();
            if (empty($entity)) {
                return backSystemError();
            }
            $entity->del_flag = delFlagOff();
            $entity->save();
            return backSuccess(transMessage('delete_success'));
        } catch (\Exception $e) {
            logError($e);
        }

        return backSystemError();
    }
}
