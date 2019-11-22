<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;
use App\Model\Stock;
use App\Model\Comment;
use App\Model\ImagesProduct;
class ProductsController extends Controller
{
    public function index()
    {  
    	$product = Product::all();
        return view('admin.products.index',['listProduct' => $product]);
    }

    public function create()
    {
        $category = Category::all();
        return view('admin.products.create',['categories' => $category]);
    }

    /**
     * Description: Để thực hiện lưu khi thêm sản phầm
     * @param  Request $request : Là một biến thể hiện 1 phản hồi đến các yêu cầu cần xử lý ở controller
     *                            để thực hiện lấy dữ liệu và kiểm tra các thao tác truyền tới
     */
    
    public function store(Request $request)
    {
        dd($request->color);
        $this->validate($request,
        [
            'txtName'=>'required|unique:products,name|min:3|max:100',
            'optCategory'=>'required',
            'noPrice'=>'required',
            'inputMainImage'=>'required',
            'inputImage'=>'max:2',
            'txtUnit'=>'required',
            'txtDescription'=>'required|min:3|max:200',
            'txtDetailDescription'=>'required|min:10|max:300',
        ],
        [
            'txtName.required'=>'Bạn chưa nhập tên thể loại',
            'txtName.unique'=>'Tên sản phẩm đã tồn tại',
            'txtName.min'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtName.max'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'optCategory.required'=>'Bạn chưa chọn thể loại',
            'noPrice.required'=>'Bạn chưa nhập giá gốc sản phẩm',
            'inputMainImage.required'=>'Bạn chưa chọn ảnh chính cho sản phẩm',
            'inputImage.max'=>'Bạn chọn nhiều nhất là 2 ảnh con',
            'txtUnit.required'=>'Bạn chưa nhập đơn vị cho sản phẩm ',
            'txtDescription.required'=>'Bạn chưa nhập mô tả sản phẩm',
            'txtDescription.min'=>'Mô tả sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtDescription.max'=>'Mô tả sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtDetailDescription.required'=>'Bạn chưa nhập mô tả chi tiết sản phẩm',
            'txtDetailDescription.min'=>'Mô tả chi tiết sản phẩm phải có độ dài từ 10 cho đến 300 ký tự',
            'txtDetailDescription.max'=>'Mô tả chi tiết sản phẩm phải có độ dài từ 10 cho đến 300 ký tự',
        ]);
        
        $products = new Product();
        $products -> name = $request->txtName;
        $products -> categories_id = $request->optCategory;
        $products -> description = $request->txtDescription;
        $products -> detail_description = $request->txtDetailDescription;
        $products -> unit_price = $request->noPrice;
        $products -> promotion_price = $request->noPromotionPrice;
        $products -> unit = $request->txtUnit; 
        $products -> status = $request->rdoStatus;
        //Lưu ảnh chính
        if($request->hasFile('inputMainImage')){
            $this->validate($request, 
                [
                    'inputMainImage' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],          
                [
                    'inputMainImage.mimes' => 'Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif',
                    'inputMainImage.max' => 'Hình ảnh dung lượng không quá 2M',
                ] 
            ); 

            //save image to public/upload/products              
            $file = $request->file('inputMainImage');
            //set name image
            $name = date('YmdHis').'_main_'.$file->getClientOriginalName(); 
            // move image to folder product
            $file -> move("upload/products/",$name);
            // save image to databse
            $products->image = $name;
        }

        $products -> save();

        // Lưu những ảnh con vào database
        if($request->hasFile('inputImage')){
            //Lưu hình ảnh vào thư mục public/upload/products              
            $files = $request->file('inputImage'); 
            //Hàm kiểm tra dữ liệu
            foreach ($files as $key => $file) { 
                //Lấy tên của file ảnh vừa chọn và thêm trường date để tránh trùng tên.
                $name = date('YmdHis').'_'.$file->getClientOriginalName(); 
                // Di chuyển vào thư mục chứa ảnh product
                $file -> move("upload/products/",$name);
                // Lấy tên lưu và csdl
                $imagesProduct = new ImagesProduct();
                $imagesProduct->products_id = $products->id;
                $imagesProduct->image = $name;
                $imagesProduct->save();
            }
        }
        // Lưu sản phẩm vào Stock
        $stock = new Stock();
        $stock->products_id = $products->id;
        $stock->save();

        return  redirect()->route('admin.product.create')->with('notification','Thêm thành công');
    }

    public function edit($id)
    {
        $products = Product::find($id);
        $categories = Category::all();
        $imagesProduct = ImagesProduct::Where('products_id',$id)->get();
        return view('admin.products.edit',compact('products','categories','imagesProduct'));
    }

    public function update(Request $request, $id)
    {
        $products = Product::find($id);
        $this->validate($request,
        [
            'txtName'=>'required|min:3|max:100',
            'optCategory'=>'required',
            'noPrice'=>'required',
            'noPromotionPrice'=>'required',
            'txtUnit'=>'required',
            'txtDescription'=>'required|min:3|max:200',
            'txtDetailDescription'=>'required|min:10|max:300',
        ],
        [
            'txtName.required'=>'Bạn chưa nhập tên thể loại',
            'txtName.min'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtName.max'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'optCategory.required'=>'Bạn chưa chọn thể loại',
            'noPrice.required'=>'Bạn chưa nhập giá sản phẩm',
            'noPromotionPrice.required'=>'Bạn chưa nhập giá sản phẩm',
            'txtUnit.required'=>'Bạn chưa nhập đơn vị cho sản phẩm ',
            'txtDescription.required'=>'Bạn chưa nhập mô tả sản phẩm',
            'txtDescription.min'=>'Mô tả sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtDescription.max'=>'Mô tả sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtDetailDescription.required'=>'Bạn chưa nhập mô tả chi tiết sản phẩm',
            'txtDetailDescription.min'=>'Mô tả chi tiết sản phẩm phải có độ dài từ 10 cho đến 300 ký tự',
            'txtDetailDescription.max'=>'Mô tả chi tiết sản phẩm phải có độ dài từ 10 cho đến 300 ký tự',
        ]);

        $products -> name = $request->txtName;
        $products -> categories_id = $request->optCategory;
        $products -> description = $request->txtDescription;
        $products -> detail_description = $request->txtDetailDescription;
        $products -> unit_price = $request->noPrice;
        $products -> promotion_price = $request->noPromotionPrice;
        $products -> unit = $request->txtUnit; 
        $products -> status = $request->rdoStatus;
        //Lưu ảnh chính
        if($request->hasFile('inputMainImage')){
            $this->validate($request, 
                [
                    'inputMainImage' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],          
                [
                    'inputMainImage.mimes' => 'Chỉ chấp nhận ảnh với đuôi .jpg .jpeg .png .gif',
                    'inputMainImage.max' => 'Hình ảnh dung lượng không quá 2M',
                ] 
            ); 

            //save image to public/upload/products              
            $file = $request->file('inputMainImage');
            //set name image
            $name = date('YmdHis').'_main_'.$file->getClientOriginalName(); 
                // move image to folder product
            $file -> move("upload/products/",$name);
                // save image to databse
            $products->image = $name;
        }
        $products -> save();

        // Lưu những ảnh con vào database
        if($request->hasFile('inputImage')){
            //Lưu hình ảnh vào thư mục public/upload/products              
            $files = $request->file('inputImage'); 
            //Hàm kiểm tra dữ liệu
            foreach ($files as $key => $file) { 
                //Lấy tên của file ảnh vừa chọn và thêm trường date để tránh trùng tên.
                $name = date('YmdHis').'_'.$file->getClientOriginalName(); 
                // Di chuyển vào thư mục chứa ảnh product
                $file -> move("upload/products/",$name);
                // Lấy tên lưu và csdl
                $imagesProduct = new ImagesProduct();
                $imagesProduct->products_id = $products->id;
                $imagesProduct->image = $name;
                $imagesProduct->save();
            }
        }

        return redirect()->back()->with('notification','Sửa thành công');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

    return redirect()->route('admin.product.index')->with('notification','Bạn đã xóa thành công sản phẩm');
    }

    /**
     * destroyImage - Hàm xóa ảnh cũ khi edit muốn thêm ảnh mới
     * @param  [int] $id [Đây là id của ảnh cũ]
     * @return Xóa ảnh trong trong database và xóa trong thư mục lưu ảnh
     */
    public function destroyImage($id){
        $imageProduct = ImagesProduct::find($id);
        unlink("upload/products/".$imageProduct->image);
        $imageProduct->delete();

        return redirect()->back()->with('noticeUpdateImage','Bạn đã xóa thành công ảnh con ban đầu');
    }

    public function destroyMainImage($id){
        $imageProduct = Product::find($id);
        unlink("upload/products/".$imageProduct->image);
        $imageProduct->image ="";
        $imageProduct->save();

        return redirect()->back()->with('notification','Bạn đã xóa thành công ảnh chính ban đầu. Bạn cần thêm 1 ảnh chính mới cho sản phẩm...');
    }

}
