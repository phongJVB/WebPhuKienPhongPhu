<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\Category;
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

        $this->validate($request,
        [
            'txtName'=>'required|unique:products,name|min:3|max:100',
            'optCategory'=>'required',
            'noPrice'=>'required',
            'noPromotionPrice'=>'required',
            'txtUnit'=>'required',
            'txtDescription'=>'required|min:3|max:200',
        ],
        [
            'txtName.required'=>'Bạn chưa nhập tên thể loại',
            'txtName.unique'=>'Tên sản phẩm đã tồn tại',
            'txtName.min'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtName.max'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'optCategory.required'=>'Bạn chưa chọn thể loại',
            'noPrice.required'=>'Bạn chưa nhập giá sản phẩm',
            'noPromotionPrice.required'=>'Bạn chưa nhập giá sản phẩm',
            'txtUnit.required'=>'Bạn chưa nhập đơn vị cho sản phẩm ',
            'txtDescription.required'=>'Bạn chưa nhập mô tả sản phẩm',
            'txtDescription.min'=>'Mô tả sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtDescription.max'=>'Mô tả sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
        ]);

        $products = new Product;
        $products -> name = $request->txtName;
        $products -> id_cate = $request->optCategory;
        $products -> description = $request->txtDescription;
        $products -> unit_price = $request->noPrice;
        $products -> promotion_price = $request->noPromotionPrice;
        $products -> unit = $request->txtUnit; 
        $products -> status = $request->rdoStatus;

        if($request->hasFile('iputImage')){
                    //Hàm kiểm tra dữ liệu
            $this->validate($request, 
                [
                    //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                    'iputImage' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],          
                [
                    //Tùy chỉnh hiển thị thông báo không thỏa mãn điều kiện
                    'iputImage.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'iputImage.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ] 
            ); 

            //Lưu hình ảnh vào thư mục public/upload/products              
            $file = $request->file('iputImage');
            //Lấy tên của file ảnh vừa chọn và thêm trường date để tránh trùng tên.
            $name = date('YmdHis').'_'.$file->getClientOriginalName(); 
            // Di chuyển vào thư mục chứa ảnh product
            $file -> move("upload/products/",$name);
            // Lấy tên lưu và csdl
            $products ->image = $name;
        }else{
            $products ->image = "";
        }

        $products -> save();

        return redirect()->route('product.create')->with('notification','Thêm thành công');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        return view('admin.products.edit',['products'=>$product,'categories'=>$category]);
    }

    public function update(Request $request, $id)
    {
        $products = Product::find($id);
        $this->validate($request,
        [
            'txtName'=>'required|unique:products,name|min:3|max:100',
            'optCategory'=>'required',
            'noPrice'=>'required',
            'noPromotionPrice'=>'required',
            'txtUnit'=>'required',
            'txtDescription'=>'required|min:3|max:200',
        ],
        [
            'txtName.required'=>'Bạn chưa nhập tên thể loại',
            'txtName.unique'=>'Tên sản phẩm đã tồn tại',
            'txtName.min'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtName.max'=>'Tên sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'optCategory.required'=>'Bạn chưa chọn thể loại',
            'noPrice.required'=>'Bạn chưa nhập giá sản phẩm',
            'noPromotionPrice.required'=>'Bạn chưa nhập giá sản phẩm',
            'txtUnit.required'=>'Bạn chưa nhập đơn vị cho sản phẩm ',
            'txtDescription.required'=>'Bạn chưa nhập mô tả sản phẩm',
            'txtDescription.min'=>'Mô tả sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
            'txtDescription.max'=>'Mô tả sản phẩm phải có độ dài từ 3 cho đến 100 ký tự',
        ]);

        $products -> name = $request->txtName;
        $products -> id_cate = $request->optCategory;
        $products -> description = $request->txtDescription;
        $products -> unit_price = $request->noPrice;
        $products -> promotion_price = $request->noPromotionPrice;
        $products -> unit = $request->txtUnit; 
        $products -> status = $request->rdoStatus;

        if($request->hasFile('iputImage')){
                    //Hàm kiểm tra dữ liệu
            $this->validate($request, 
                [
                    //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                    'iputImage' => 'mimes:jpg,jpeg,png,gif|max:2048',
                ],          
                [
                    //Tùy chỉnh hiển thị thông báo không thỏa mãn điều kiện
                    'iputImage.mimes' => 'Chỉ chấp nhận hình thẻ với đuôi .jpg .jpeg .png .gif',
                    'iputImage.max' => 'Hình thẻ giới hạn dung lượng không quá 2M',
                ] 
            ); 

            //Lưu hình ảnh vào thư mục public/upload/products              
            $file = $request->file('iputImage');
            //Lấy tên của file ảnh vừa chọn và thêm trường date để tránh trùng tên.
            $name = date('YmdHis').'_'.$file->getClientOriginalName(); 
            // Di chuyển vào thư mục chứa ảnh product
            $file -> move("upload/products/",$name);
            // Xóa tên ảnh cũ đi để tránh trùng
            unlink("upload/products/".$products->image);
            // Lấy tên lưu và csdl
            $products->image = $name;
        }else{
            $products->image = "";
        }

        $products -> save();

        return redirect()->route('product.edit',[ $products->id ])->with('notification','Sửa thành công');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('product.index')->with('notification','Bạn đã xóa thành công');
    }

}
